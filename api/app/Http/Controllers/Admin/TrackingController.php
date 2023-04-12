<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
class TrackingController extends Controller {
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list() {
        if (Auth::id() === env('RID')) {
            $data = DB::table('v_device_relay')
            ->where('logs_id','<>', null)
            ->orderBy('created_at','desc')
            ->get();
        }else{
            $data = DB::table('v_device_relay')
            ->where('uuid_customer_id','=',Auth::id())
            ->where('logs_id','<>', null)
            // ->orWhereNotNull('logs_id')
            // ->where('uuid_customer_id','=',Auth::id())
            ->orderBy('created_at','desc')
            ->get();
        }
        
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function detail($device_id) {
        if (Auth::id() === env('RID')) {
            $deviceRelay = DB::table('v_device_relay')
            ->where('ftdevice_id','=', $device_id)
            ->first();
            $deviceIgnition = DB::table('v_device_ignition')
            ->selectRaw('created_at,ffbattery,fnsattelite,fnsignal,fncellular,ftcellular,fbpower')
            ->where('ftdevice_id','=', $device_id)
            ->first();
        }else{
            $deviceRelay = DB::table('v_device_relay')
            ->where('ftdevice_id','=', $device_id)
            ->where('uuid_customer_id','=',Auth::id())
            ->first();
            $deviceIgnition = DB::table('v_device_ignition')
            ->selectRaw('created_at,ffbattery,fnsattelite,fnsignal,fncellular,ftcellular,fbpower')
            ->where('ftdevice_id','=', $device_id)
            ->where('uuid_customer_id','=',Auth::id())
            ->first();
        }
        
        return response()->json([
            'deviceRelay' => $deviceRelay,
            'deviceIgnition' => $deviceIgnition,
        ], 200);
    }

    public function tracking_map(Request $request) {
        $this->validate($request, [
            'did' => 'required',
            'from' => 'required|date_format:Y-m-d H:i:s',
            'to' => 'required|date_format:Y-m-d H:i:s',
        ]);
        $did = $request->input('did');
        $from = $request->input('from');
        $to = $request->input('to');

        if (Auth::id() === env('RID')) {
            $routes = DB::table('debuging_routes')
            ->selectRaw("id,ftdevice_id,fflat,fflon,fngeo_id,fngeo_chkpoint,created_at,fttype,ffaccuracy_cep,ffdirection,ffspeed,ffbattery,ffaltitude")
            ->where('ftdevice_id','=',$did)
            ->where('fttype','=', 'R1')
            ->whereBetween('created_at', [$from, $to])
            ->orWhere('ftdevice_id','=',$did)
            ->where('fttype','=', '2F')
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at','asc')
            ->get();
        }else{
            $routes = DB::table('debuging_routes')
            ->selectRaw("id,ftdevice_id,fflat,fflon,fngeo_id,fngeo_chkpoint,created_at,fttype,ffaccuracy_cep,ffdirection,ffspeed,ffbattery,ffaltitude")
            ->where('ftdevice_id','=',$did)
            ->where('fttype','=', 'R1')
            ->where('uuid_customer_id','=',Auth::id())
            ->whereBetween('created_at', [$from, $to])
            ->orWhere('ftdevice_id','=',$did)
            ->where('fttype','=', '2F')
            ->where('uuid_customer_id','=',Auth::id())
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at','asc')
            ->get();
        }

        return response()->json([
            'data' => $routes,
        ], 200);
    }

    public function tracking_geo($device_id) {

        if (Auth::id() === env('RID')) {
            $data = DB::table('v_geo_history')
            ->selectRaw('id,fddeclaration as created_at,ftdevice_id,ftgeo_name,ftaddress, fbdeclaration as fngeo_declare,fddeclaration_exit,ftduration')
            ->where('ftdevice_id','=', $device_id)
            ->orderBy('fddeclaration','desc')
            ->get();
        }else{
            $data = DB::table('v_geo_history')
            ->selectRaw('id,fddeclaration as created_at,ftdevice_id,ftgeo_name,ftaddress, fbdeclaration as fngeo_declare,fddeclaration_exit,ftduration')
            ->where('uuid_customer_id','=',Auth::id())
            ->where('ftdevice_id','=', $device_id)
            // ->groupBy('id','created_at','ftdevice_id','ftgeo_name','ftaddress','fngeo_declare')
            ->orderBy('fddeclaration','desc')
            ->get();
        }
        
        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function tracking_mlff_declare_log($device_id) {
        $res = DB::table('v_device_geo_mlff_declare')
        ->where('ftdevice_id','=', $device_id)
        ->orderBy('fddeclaration','desc')
        ->get();
        return response()->json([
            'data' => $res,
        ], 200);
    }
}