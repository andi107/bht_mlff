<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
class GeoMlffController extends Controller {
    public function list() {

        $data = DB::table('x_geo_mlff_declare')
        ->orderBy('created_at','desc')
        ->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'id' => 'required',
            'geo_name' => 'required|max:100',
            'geo_address' => 'required|max:255',
            'geo_type' => 'required|numeric',
            'status' => 'required|numeric'
        ]);
        $id = $request->input('id');
        $geo_name = $request->input('geo_name');
        $geo_address = $request->input('geo_address');
        $geo_type = $request->input('geo_type');
        $status = $request->input('status');
        
        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            DB::table('x_geo_mlff_declare')
            ->insert([
                'id' => $id,
                'ftgeo_name' => $geo_name,
                'ftaddress' => $geo_address,
                'fntype' => $geo_type,
                'fnstatus' => $status,
                'created_at' => $dtnow,
                'updated_at' => $dtnow
            ]);

            switch ($geo_type) {
                case '1':
                    
                    $polygon_point = json_decode($request->input('polygon_point'));
                    foreach ($polygon_point as $key => $value) {
                        DB::table('x_geo_mlff_declare_det')
                        ->insert([
                            'id' => Str::uuid(),
                            'x_geo_mlff_declare_id' => $id,
                            'fflat' => $value->lat,
                            'fflon' => $value->lng,
                            'fnindex' => $key,
                            'fnchkpoint' => 0
                        ]);
                    }
                    break;
                default:
                    DB::rollback();
                    return response()->json([], 500);
                    break;
            }
            DB::commit();
            return response()->json([], 200);
            
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'error' => 'Internal Server Error.',
            ], 500)
                ->header('X-Content-Type-Options', 'nosniff')
                ->header('X-Frame-Options', 'DENY')
                ->header('X-XSS-Protection', '1; mode=block')
                ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
        }
    }

    public function update(Request $request) {
        $this->validate($request, [
            'id' => 'required',
            'geo_name' => 'required|max:100',
            'geo_address' => 'required|max:255',
            'geo_type' => 'required|numeric',
            'status' => 'required|numeric'
        ]);
        $id = $request->input('id');
        $geo_name = $request->input('geo_name');
        $geo_address = $request->input('geo_address');
        $geo_type = $request->input('geo_type');
        $status = $request->input('status');
        
        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            DB::table('x_geo_mlff_declare')
            ->where('id','=',$id)
            ->update([
                'ftgeo_name' => $geo_name,
                'ftaddress' => $geo_address,
                'fntype' => $geo_type,
                'fnstatus' => $status,
                'updated_at' => $dtnow
            ]);

            switch ($geo_type) {
                case '1':
                    $polygon_point = json_decode($request->input('polygon_point'));
                    DB::table('x_geo_mlff_declare_det')
                    ->where('x_geo_mlff_declare_id','=',$id)
                    ->delete();
                    foreach ($polygon_point as $key => $value) {
                        DB::table('x_geo_mlff_declare_det')
                        ->insert([
                            'id' => Str::uuid(),
                            'x_geo_mlff_declare_id' => $id,
                            'fflat' => $value->lat,
                            'fflon' => $value->lng,
                            'fnindex' => $key,
                            'fnchkpoint' => 0
                        ]);
                    }
                    break;
                default:
                    DB::rollback();
                    return response()->json([], 500);
                    break;
            }
            DB::commit();
            return response()->json([], 200);
            
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'error' => 'Internal Server Error.',
            ], 500)
                ->header('X-Content-Type-Options', 'nosniff')
                ->header('X-Frame-Options', 'DENY')
                ->header('X-XSS-Protection', '1; mode=block')
                ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
        }
    }

    public function detail($geoid) {
        $data = DB::table('x_geo_mlff_declare')
        ->where('id','=', $geoid)
        ->first();
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function detail_point($geoid) {
        $data = DB::table('x_geo_mlff_declare_det')
        ->selectRaw('id,fflat,fflon,fnindex')
        ->where('x_geo_mlff_declare_id','=', $geoid)
        ->orderBy('fnindex','asc')
        ->get();
        return response()->json([
            'data' => $data
        ], 200);
    }
}