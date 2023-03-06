<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hlp;
use Carbon\Carbon;
class TrackingController extends Controller
{
    public function device_list_js() {
        $res = Hlp::apiGet('/tracking');
        if (!$res) {
            return response()->json([], 404);
        }
        return response()->json([
            'data' => $res->data
        ], 200);
    }

    public function detail_js_map(Request $request) {
        $did = $request->input('did');
        $from = str_replace('T',' ', $request->input('from'));
        $to = str_replace('T',' ', $request->input('to'));
        $humanTz = $request->input('humanTz');
        $res = Hlp::apiGet('/tracking/d/map/relay?did='. $did .'&from='. Hlp::dtHumanToUTC($from, $humanTz) .'&to='. Hlp::dtHumanToUTC($to, $humanTz));
        if ($res) {
            return response()->json([
                'relay' => $res
            ], 200);
        }else{
            return response()->json([
                'relay' => null
            ], 200);
        }
    }

    public function detail_js_geo($device_id) {
        $resGeoHistory = Hlp::apiGet('/tracking/d/'. $device_id . '/geo');
        return response()->json([
            'geoData' => $resGeoHistory
        ], 200);
    }
    
    public function list() {
        return view('pages.tracking.list');
    }

    // Route::get('detail/{deviceid}/status', 'detail_status')->name('tracking_status');
    // Route::get('detail/{deviceid}/map', 'detail_map')->name('tracking_map');
    // Route::get('detail/{deviceid}/geofence', 'detail_geo')->name('tracking_geo');

    public function detail_status($device_id) {
        $resDvStatus = Hlp::apiGet('/tracking/d/'. $device_id);
        // dd($resDvStatus);
        return view('pages.tracking.form_status',[
            'cfg' => [
                'title' => $resDvStatus->deviceRelay->ftdevice_id,
                'deviceid' => $resDvStatus->deviceRelay->ftdevice_id,
            ],
            'deviceData' => $resDvStatus
        ]);
    }

    public function detail_map($device_id) {
        $td = '2023-02-28 09:41:38';
        // $creat_at = Carbon::parse($td)
        // // ->createFromTimestampUTC(420);
        // ->utcOffset(420);
        // dd(Hlp::dtHumanToUTC($td,'Asia/Jakarta'));
        // dd(Carbon::now()->toString(),$creat_at,$date);
        $resDvStatus = Hlp::apiGet('/tracking/d/'. $device_id);
        return view('pages.tracking.form_map',[
            'cfg' => [
                'title' => $resDvStatus->deviceRelay->ftdevice_id
            ],
            'deviceData' => $resDvStatus,
            // 'curStartDate' => 
        ]);
    }

    public function detail_geo($device_id) {
        $resDvStatus = Hlp::apiGet('/tracking/d/'. $device_id);
        return view('pages.tracking.form_geo',[
            'cfg' => [
                'title' => $resDvStatus->deviceRelay->ftdevice_id
            ],
            'deviceData' => $resDvStatus,
        ]);
    }

}
