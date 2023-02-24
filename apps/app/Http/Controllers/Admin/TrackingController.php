<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hlp;
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
        $res = Hlp::apiGet('/tracking/d/map/relay?did='. $did .'&from='. $from .'&to='. $to);
        return response()->json([
            'relay' => $res
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
                'title' => $resDvStatus->deviceRelay->ftdevice_id
            ],
            'deviceData' => $resDvStatus
        ]);
    }

    public function detail_map($device_id) {
        $resDvStatus = Hlp::apiGet('/tracking/d/'. $device_id);
        return view('pages.tracking.form_map',[
            'cfg' => [
                'title' => $resDvStatus->deviceRelay->ftdevice_id
            ],
            'deviceData' => $resDvStatus
        ]);
    }

    public function detail_geo($device_id) {
        $resDvStatus = Hlp::apiGet('/tracking/d/'. $device_id);
        return view('pages.tracking.form',[
            'cfg' => [
                'title' => $resDvStatus->deviceRelay->ftdevice_id
            ],
            'deviceData' => $resDvStatus
        ]);
    }

}
