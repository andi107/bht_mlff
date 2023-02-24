<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class TrackingController extends Controller {

    public function list() {
        $data = DB::table('v_device_relay')
        ->orWhereNotNull('logs_id')
        ->get();
        // $data = DB::table('x_device')
        // ->orderBy('created_at','desc')
        // ->get();
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function detail($device_id) {
        // SELECT * from v_device_ignition
        // SELECT * From v_device_relay
        $deviceRelay = DB::table('v_device_relay')
        ->where('ftdevice_id','=', $device_id)
        ->first();
        $deviceIgnition = DB::table('v_device_ignition')
        ->selectRaw('ffbattery,fnsattelite,fnsignal')
        ->where('ftdevice_id','=', $device_id)
        ->first();
        
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

        $routes = DB::table('debuging_routes')
        ->selectRaw("id,ftdevice_id,fflat,fflon,fngeo_id,fngeo_chkpoint,created_at,fttype,ffaccuracy_cep,ffdirection,ffspeed,ffbattery")
        ->where('ftdevice_id','=',$did)
        ->where('fttype','=', 'R1')
        ->whereBetween('created_at', [$from, $to])
        ->orderBy('created_at','asc')
        ->get();

        return response()->json([
            'data' => $routes,
        ], 200);
    }
}