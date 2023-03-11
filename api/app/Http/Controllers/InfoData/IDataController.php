<?php

namespace App\Http\Controllers\InfoData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
class IDataController extends Controller {

    public function geo_information($geoid) {
        $data = DB::table('x_geo_declare')
        ->where('id','=', $geoid)
        ->first();
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function device_information($deviceid) {
        $data = DB::table('x_devices')
        ->where('ftdevice_id','=', $deviceid)
        ->first();
        return response()->json([
            'data' => $data
        ], 200);
    }
}