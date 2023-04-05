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
        $data = DB::table('v_device_relay')
        ->where('uuid_customer_id','=',Auth::id())
        ->where('logs_id','<>', null)
        // ->orWhereNotNull('logs_id')
        // ->where('uuid_customer_id','=',Auth::id())
        ->orderBy('created_at','desc')
        ->get();
        // dd($data);
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function detail($device_id) {
        // SELECT * from v_device_ignition
        // SELECT * From v_device_relay
        $deviceRelay = DB::table('v_device_relay')
        ->where('ftdevice_id','=', $device_id)
        ->where('uuid_customer_id','=',Auth::id())
        ->first();
        $deviceIgnition = DB::table('v_device_ignition')
        ->selectRaw('created_at,ffbattery,fnsattelite,fnsignal,fncellular,ftcellular,fbpower')
        ->where('ftdevice_id','=', $device_id)
        ->where('uuid_customer_id','=',Auth::id())
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

        return response()->json([
            'data' => $routes,
        ], 200);
    }

    public function tracking_geo($device_id) {

        // $t1 = Carbon::parse('2016-07-03 12:29:16');
        // $t2 = Carbon::parse('2016-07-04 13:30:10');
        // $diff = $t1->diffInYears($t2);
        // dd($diff);
        $data = DB::table('v_geo_history')
        ->selectRaw('id,fddeclaration as created_at,ftdevice_id,ftgeo_name,ftaddress, fbdeclaration as fngeo_declare')
        ->where('uuid_customer_id','=',Auth::id())
        ->where('ftdevice_id','=', $device_id)
        // ->groupBy('id','created_at','ftdevice_id','ftgeo_name','ftaddress','fngeo_declare')
        ->orderBy('fddeclaration','desc')
        ->get();
        // foreach ($data as $avalue) {
        //     foreach ($avalue as $a_key => $a_value) {
        //         if ($a_key == 'id') {
        //             echo $a_value . PHP_EOL;
        //         }
        //     }
        // }
        
        return response()->json([
            'data' => $data,
        ], 200);

        // $dtFrom = DB::table('v_geo_history')
        // ->selectRaw('created_at')
        // ->where('ftdevice_id','=', $device_id)
        // ->orderBy('created_at','asc')
        // ->first();
        // $dtEnd = DB::table('v_geo_history')
        // ->selectRaw('created_at')
        // ->where('ftdevice_id','=', $device_id)
        // ->orderBy('created_at','desc')
        // ->first();
        // // dd($dtFrom->created_at);
        // // sprintf("There are %u million bicycles in %s.",$number,$str);
        // if ($dtFrom && $dtEnd) {
        //     $qr = sprintf("select d.dt as created_at, t.* ".
        //     " from generate_series ( ".
        //     "    date '%s', date '%s', interval '1' day ".
        //     ") d (dt) left join lateral ( ".
        //     "    select t.ftdevice_id,t.ftgeo_name,t.ftaddress,t.fngeo_declare from v_geo_history t ".
        //     "       where t.created_at >= d.dt and t.created_at < d.dt + interval '1' day ".
        //     ") t  on true where t.ftdevice_id = '%s'".
        //     " group by d.dt, t.ftdevice_id,t.ftgeo_name,t.ftaddress,t.fngeo_declare ".
        //     "order by d.dt desc",$dtFrom->created_at,$dtEnd->created_at,$device_id);
            
        //     $data = DB::select((string)$qr);
        //     // foreach ($data as $avalue) {
        //     //     dd($avalue);
        //     // }
        //     return response()->json([
        //         'data' => $data,
        //     ], 200);
        // }else{
        //     return response()->json([
        //         'data' => null,
        //     ], 200);
        // }
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