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

    public function gate_polygon() {
        $geoGate = DB::table('v_geo_mlff_declare')
        ->get();
        foreach ($geoGate as $a_value) {
            $tmpPoint = [];
            $tmpLastPoint = null;
            $resDecM = DB::table('x_geo_mlff_declare_det')
            ->where('x_geo_mlff_declare_id','=',$a_value->id)
            ->orderBy('fnchkpoint','asc')
            ->orderBy('fnindex','asc')
            ->get();
            foreach ($resDecM as $b_value) {
                if ($b_value->fnindex == 0) {
                    $tmpLastPoint = [$b_value->fflon,$b_value->fflat];
                }
                $tmpPoint[$b_value->fnindex] = [$b_value->fflon,$b_value->fflat];
            }
            if ($tmpLastPoint) {
                $tmpPoint[count($tmpPoint) - 1] = $tmpLastPoint;
            }
            $a_value->polygon = $tmpPoint;
        }
        return response()->json([
            'data' => $geoGate
        ], 200);
    }

    public function toll_section_point() {
        $data = DB::table('x_geo_toll_route_det')
        ->selectRaw('fflon,fflat')
        ->get();
        // $data = [];
        // foreach (DB::table('x_geo_toll_route_det')->get() as $a_key => $a_value) {
        //     // {
        //     //     type: "Feature",
        //     //     properties: {},
        //     //     geometry: { type: "Point", coordinates: [110.534438333162598, -7.357956666866642] },
        //     // }
        //     $data[$a_key] = [
        //         'type' => 'Feature',
        //         // 'properties' => [],
        //         'geometry' => [
        //             'type' => 'Point',
        //             'coordinates' => [(float)$a_value->fflon, (float)$a_value->fflat]
        //         ]
        //     ];
        // }
        return response()->json([
            'data' => $data
        ],200);
    }
}