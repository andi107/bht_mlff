<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class GeoController extends Controller {
    
    public function list() {

        $data = DB::table('x_geo_declare')
        ->orderBy('created_at','desc')
        ->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request) {
        // 'geo_name' => $re->input('txtName'),
        //     'geo_address' => $re->input('txtAddress'),
        //     'geo_type' => $re->input('_geotype'),
        //     'polygon_point' => $re->input('polygon_point'),
        //     'status' => 1
        $this->validate($request, [
            'id' => 'required',
            'geo_name' => 'required|max:100',
            'geo_address' => 'required|max:255',
            'geo_type' => 'required|numeric',
            'status' => 'required|numeric'
        ]);
        $geo_name = $request->input('geo_name');
        $geo_address = $request->input('address');
        $geo_type = $request->input('geo_type');
        $status = $request->input('status');
        if ($geo_type == 1) {
            $polygon_point = $request->input('polygon_point');
        }
        DB::beginTransaction();
        // try {
            
            DB::table('x_geo_declare')
            ->insert([

            ]);

            DB::table('x_geo_declare_det')
            ->insert([

            ]);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'error' => 'Internal Server Error.',
        //     ], 500)
        //         ->header('X-Content-Type-Options', 'nosniff')
        //         ->header('X-Frame-Options', 'DENY')
        //         ->header('X-XSS-Protection', '1; mode=block')
        //         ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
        // }
    }

}