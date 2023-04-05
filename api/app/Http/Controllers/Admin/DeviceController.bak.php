<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DeviceController extends Controller {
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $data = DB::table('x_devices')
        ->orderBy('created_at','desc')
        ->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request) {

        $this->validate($request, [
            'device_id' => 'required|max:100',
            'name' => 'required|max:100',
            'type' => 'required|numeric|min:1',
            'description' => 'max:255',
            'vehicle_id' => 'required|max:50',
            'vehicle_name' => 'required|max:100',
            'status' => 'required|numeric',
            'customer_id' => 'required|numeric'
        ]);
        $device_id = $request->input('device_id');
        $name = $request->input('name');
        $type = $request->input('type');
        $description = $request->input('description');
        $vehicle_id = $request->input('vehicle_id');
        $vehicle_name = $request->input('vehicle_name');
        $status = $request->input('status');
        $customer_id = $request->input('customer_id');
        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            
            $chkData = DB::table('x_devices')
            ->where('ftdevice_id','=', $device_id)
            ->first();
            $chkVehicle_id = DB::table('x_devices')
            ->where('ftvehicle_id','=',$vehicle_id)
            ->first();
            if ($chkUser) {
                return response()->json([
                    'msg' => 'Customer not found.',
                ], 442);
            }else if ($chkData) {
                return response()->json([
                    'msg' => $device_id. ' already exists.',
                ], 442);
            }else if($chkVehicle_id) {
                return response()->json([
                    'msg' => $vehicle_id. ' already exists.',
                ], 442);
            }

            DB::table('x_devices')
            ->insert([
                'ftdevice_id' => $device_id,
                'ftname' => $name,
                'fttype' => $type,
                'ftdescription' => $description,
                'created_at' => $dtnow,
                'updated_at' => $dtnow,
                'ftvehicle_id' => $vehicle_id,
                'ftvehicle_name' => $vehicle_name,
                'fnstatus' => $status,
                'uuid_customer_id' => $customer_id
            ]);

            $data = DB::table('x_devices')
            ->where('ftdevice_id','=', $device_id)
            ->first();

            DB::commit();
            return response()->json([
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
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
            'device_id' => 'required|max:100',
            'name' => 'required|max:100',
            'description' => 'max:255',
            'vehicle_id' => 'required|max:50',
            'vehicle_name' => 'required|max:100',
            'status' => 'required|numeric'
        ]);
        $device_id = $request->input('device_id');
        $name = $request->input('name');
        $description = $request->input('description');
        $vehicle_id = $request->input('vehicle_id');
        $vehicle_name = $request->input('vehicle_name');
        $status = $request->input('status');
        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            $chkData = DB::table('x_devices')
            ->where('ftdevice_id','=', $device_id)
            ->first();
            $chkName = DB::table('x_devices')
            ->where('ftdevice_id','<>', $device_id)
            ->where('ftvehicle_id','=', $vehicle_id)
            ->first();
            if (!$chkData) {
                return response()->json([
                    'msg' => $device_id. ' not found.',
                ], 442);
            }else if ($chkName) {
                return response()->json([
                    'msg' => $name. ' already exists.',
                ], 442);
            }
            
            DB::table('x_devices')
            ->where('ftdevice_id','=', $device_id)
            ->update([
                'ftname' => $name,
                'ftdescription' => $description,
                'updated_at' => $dtnow,
                'ftvehicle_id' => $vehicle_id,
                'ftvehicle_name' => $vehicle_name,
                'fnstatus' => $status
            ]);

            $data = DB::table('x_devices')
            ->where('ftdevice_id','=', $device_id)
            ->first();

            DB::commit();
            return response()->json([
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error.',
            ], 500)
                ->header('X-Content-Type-Options', 'nosniff')
                ->header('X-Frame-Options', 'DENY')
                ->header('X-XSS-Protection', '1; mode=block')
                ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
        }
    }

    public function list() {
        $data = DB::table('x_devices')
        ->get();
        $geoData = DB::table('x_geo_declare')
        ->get();
        foreach ($geoData as $avalue) {
            foreach ($avalue as $a_key => $a_value) {
                if ($a_key == 'id') {
                    $avalue->polygon = DB::table('v_geo_declare_adv')
                    ->selectRaw('fnchkpoint,fnindex,fflat,fflon,ftstate')
                    ->where('x_geo_declare_id','=',$a_value)
                    ->where('fnchkpoint','=', '0')
                    ->orderBy('fnchkpoint','asc')
                    ->orderBy('fnindex','asc')
                    ->get();
                    $avalue->polygon_lts = DB::table('v_geo_declare_adv')
                    ->selectRaw('fnchkpoint,fnindex,fflat,fflon,ftstate')
                    ->where('x_geo_declare_id','=',$a_value)
                    ->where('fnchkpoint','=', '0')
                    ->orderBy('fnchkpoint','asc')
                    ->orderBy('fnindex','asc')
                    ->first();
                }
            }
        }

        return response()->json([
            'geodata' => $geoData,
            'data' => $data,
        ], 200);
    }

}