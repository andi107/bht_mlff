<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DeviceController extends Controller {
    
    public function index() {

        $data = DB::table('x_geo_declare')
        ->orderBy('created_at','desc')
        ->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request) {

        $this->validate($request, [
            'geo_name' => 'required|max:100',
            'address' => 'required|max:255',
            'status' => 'required|numeric'
        ]);
        $geo_name = $request->input('geo_name');
        $geo_address = $request->input('address');
        $status = $request->input('status');
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