<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Auth;

use Illuminate\Contracts\Auth\Guard;
class DashboardController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $data = DB::table('v_device_relay')
        ->where('uuid_customer_id','=', Auth::id())
        ->where('logs_id','<>', null)
        // ->orWhereNotNull('logs_id')
        ->orderBy('ftdevice_name','asc')
        ->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function test(Request $request) {
        
        $this->validate($request, [
            'gate_name' => 'required|max:100',
            'type' => 'required',
            'description' => 'max:255',
            'point_lat' => 'required',
            'point_lon' => 'required',
        ]);
        $gate_name = $request->input('gate_name');
        $type = $request->input('type');
        $description = $request->input('description');
        $point_lat = $request->input('point_lat');
        $point_lon = $request->input('point_lon');

        $tes = DB::table('x_gate_point')
        ->insert([
            'id' => Str::uuid(),
            'ftname' => $gate_name,
            'fttype' => $type,
            'ftdescription' => $description,
            'fflat' => $point_lat,
            'fflon' => $point_lon,
            'created_at' => Carbon::now(),
        ]);
        return response()->json([
            'data' => 'OK',
        ], 200);
    }

    public function importSection(Request $request) {

        $this->validate($request, [
            'id' => 'required',
            'section_name' => 'required',
            'address' => 'required',
            'type' => 'required',
            'island' => 'required',
            'length' => 'required',
            'manager' => 'required',
            'status' => 'required',
        ]);
        $id = $request->input('id');
        $section_name = $request->input('section_name');
        $address = $request->input('address');
        $type = $request->input('type');
        $island = $request->input('island');
        $length = $request->input('length');
        $manager = $request->input('manager');
        $status = $request->input('status');
        $dtnow = Carbon::now();
        DB::table('x_geo_toll_route')
        ->insert([
            'id' => $id,
            'ftsection_name' => $section_name,
            'ftaddress' => $address,
            'fttype' => $type,
            'ftisland' => $island,
            'ftlength' => $length,
            'ftmanager' => $manager,
            'ftstatus' => $status,
            'created_at' => $dtnow,
            'updated_at' => $dtnow,
        ]);
        return response()->json([
            'data' => $id,
        ], 200);
    }
    
    public function importSectionLatLng(Request $request) {
        $this->validate($request, [
            'x_geo_toll_route_id' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'checkpoint' => 'required',
            'index' => 'required',
        ]);
        $x_geo_toll_route_id = $request->input('x_geo_toll_route_id');
        $lat = $request->input('lat');
        $lon = $request->input('lon');
        $checkpoint = $request->input('checkpoint');
        $index = $request->input('index');
        $id = Str::uuid();
        DB::table('x_geo_toll_route_det')
        ->insert([
            'id' => $id,
            'x_geo_toll_route_id' => $x_geo_toll_route_id,
            'fflat' => $lat,
            'fflon' => $lon,
            'fnindex' => $index,
            'fnchkpoint' => $checkpoint
        ]);
        return response()->json([
            'data' => $id,
        ], 200);
    }
}