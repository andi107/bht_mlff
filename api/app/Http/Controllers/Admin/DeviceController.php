<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

use Illuminate\Contracts\Auth\Guard;
class DeviceController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list() {
        // dd(Auth::id());
        $data = DB::table('x_devices')
        ->where('uuid_customer_id','=', Auth::id())
        ->orderBy('created_at','desc')
        ->get();
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function detail($deviceid) {
        $data = DB::table('x_devices')
        ->where('ftdevice_id','=', $deviceid)
        ->where('uuid_customer_id','=', Auth::id())
        ->first();
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function create(Request $request) {
        
        $this->validate($request, [
            'device_type' => 'required|min:1|numeric',
            'device_id' => 'required|max:100',
            'device_name' => 'required|max:100',
            'asset_id' => 'required|max:50',
            'asset_name' => 'required|max:100',
            // 'asset_type' => 'required|max:100',
            // 'customer_id' => 'required',
            'description' => 'max:255',
            'status' => 'required|numeric'
        ]);

        $device_type = $request->input('device_type');
        $device_id = str_replace(' ','-', $request->input('device_id'));
        $device_name = $request->input('device_name');
        $asset_id = $request->input('asset_id');
        $asset_name = $request->input('asset_name');
        // $asset_type = $request->input('asset_type');
        // $customer_id = $request->input('customer_id');
        $description = $request->input('description');
        $status = $request->input('status');
        DB::beginTransaction();
        try {

            // $chkUser = DB::table('users')
            // ->where('uid','=', $customer_id)
            // ->where('fnstatus','=', 1)
            // ->first();

            $exData = DB::table('x_devices')
            ->where('ftdevice_id','=',$device_id)
            ->first();
            $exAssetData = DB::table('x_devices')
            ->where('ftasset_id','=',$asset_id)
            ->first();
            
            // if ($chkUser) {
            //     return response()->json([
            //         'error' => 'Customer not found.'
            //     ], 404);
            // } else 
            if ($exData) {
                return response()->json([
                    'error' => 'The Device '.$device_id.' already exists.'
                ], 404);
            } else if ($exAssetData) {
                return response()->json([
                    'error' => 'The Asset ' . $asset_id.' already exists.'
                ], 404);
            } 
            // else if (!$exCustomer) {
            //     return response()->json([
            //         'msg' => 'Customer name not found.'
            //     ], 404);
            // }

            $dtnow = Carbon::now();
            DB::table('x_devices')
            ->insert([
                'ftdevice_id' => $device_id,
                'ftdevice_name' => $device_name,
                'ftasset_id' => $asset_id,
                'ftasset_name' => $asset_name,
                // 'ftasset_type' => $asset_type,
                'ftasset_description' => $description,
                'fncategory' => $device_type,
                // 'ftcustomer_name' => $customer_name,
                'fnstatus' => $status,
                'created_at' => $dtnow,
                'updated_at' => $dtnow,
                'uuid_customer_id' => Auth::id()
            ]);
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
            'device_type' => 'required|min:1|numeric',
            'device_id' => 'required|max:100',
            'device_name' => 'required|max:100',
            'asset_id' => 'required|max:50',
            'asset_name' => 'required|max:100',
            // 'asset_type' => 'required|max:100',
            // 'customer_name' => 'required|max:100',
            'description' => 'max:255',
            'status' => 'required|numeric'
        ]);

        $device_type = $request->input('device_type');
        $device_id = $request->input('device_id');
        $device_name = $request->input('device_name');
        $asset_id = $request->input('asset_id');
        $asset_name = $request->input('asset_name');
        // $asset_type = $request->input('asset_type');
        // $customer_name = $request->input('customer_name');
        $description = $request->input('description');
        $status = $request->input('status');
        DB::beginTransaction();
        try {

            $exData = DB::table('x_devices')
            ->where('ftdevice_id','=',$device_id)
            ->where('uuid_customer_id','=', Auth::id())
            ->first();
            $exAssetData = DB::table('x_devices')
            ->where('ftdevice_id','<>',$device_id)
            ->where('ftasset_id','=',$asset_id)
            ->first();
            // $exCustomer = DB::table('x_customer')
            // ->where('ftcustomer_name','=', $customer_name)
            // ->first();

            if (!$exData) {
                return response()->json([
                    'error' => $device_id.' not found.'
                ], 404);
            } else if ($exAssetData) {
                return response()->json([
                    'error' => $asset_id.' already added.'
                ], 404);
            }
            // else if (!$exCustomer) {
            //     return response()->json([
            //         'msg' => 'Customer name not found.'
            //     ], 404);
            // }

            $dtnow = Carbon::now();
            DB::table('x_devices')
            ->where('ftdevice_id','=',$device_id)
            ->where('uuid_customer_id','=', Auth::id())
            ->update([
                'ftdevice_name' => $device_name,
                'ftasset_id' => $asset_id,
                'ftasset_name' => $asset_name,
                // 'ftasset_type' => $asset_type,
                'ftasset_description' => $description,
                'fncategory' => $device_type,
                // 'ftcustomer_name' => $customer_name,
                'fnstatus' => $status,
                'updated_at' => $dtnow
            ]);
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

}