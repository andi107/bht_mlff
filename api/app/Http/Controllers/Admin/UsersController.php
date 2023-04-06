<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller {
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $data = DB::table('users')
        ->selectRaw('uid,email,ftfirst_name,ftlast_name,created_at,updated_at,fnstatus, (select count(*) from x_devices where uuid_customer_id = users.uid) as total_device')
        ->orderBy('created_at','desc')
        ->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'id' => 'required',
            'email' => 'required|max:100',
            'password' => 'required|max:100',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'status' => 'required|numeric',
            'tlp' => 'required|max:20',
            'address' => 'required|max:255'
        ]);
        $id = $request->input('id');
        $email = $request->input('email');
        $password = $request->input('password');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $status = $request->input('status');
        $tlp = $request->input('tlp');
        $address = $request->input('address');
        DB::beginTransaction();
        try {
            $chkEmail = DB::table('users')
            ->where('email','=', $email)
            ->first();
            
            if ($chkEmail) {
                return response()->json([
                    'msg' => $email.' already exists.',
                ], 442);
            }

            $dtnow = Carbon::now();
            DB::table('users')
            ->insert([
                'uid' => $id,
                'email' => $email,
                'password' => Hash::make($password),
                'ftfirst_name' => $first_name,
                'ftlast_name' => $last_name,
                'created_at' => $dtnow,
                'updated_at' => $dtnow,
                'fnstatus' => $status,
                'ftaddress' => $tlp,
                'ftaddress' => $address
            ]);

            DB::commit();
            return response()->json([], 200);
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
            'id' => 'required',
            'password' => 'required|max:100',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'status' => 'required|numeric',
            'tlp' => 'required|max:20',
            'address' => 'required|max:255'
        ]);
        $id = $request->input('id');
        $password = $request->input('password');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $status = $request->input('status');
        $tlp = $request->input('tlp');
        $address = $request->input('address');
        DB::beginTransaction();
        // try {
            $dtnow = Carbon::now();

            $chkEmail = DB::table('users')
            ->where('uid','=', $id)
            ->first();
            
            if (!$chkEmail) {
                return response()->json([
                    'msg' => $email.' not found',
                ], 442);
            }

            DB::table('users')
            ->where('uid','=', $id)
            ->update([
                'password' => Hash::make($password),
                'ftfirst_name' => $first_name,
                'ftlast_name' => $last_name,
                'updated_at' => $dtnow,
                'fnstatus' => $status,
                'fttelphone' => $tlp,
                'ftaddress' => $address
            ]);

            DB::commit();
            return response()->json([], 200);
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

    public function detail($uid) {
        $data = DB::table('users')
        ->selectRaw('uid,email,ftfirst_name,ftlast_name,fnstatus,fttelphone,ftaddress')
        ->where('uid','=', $uid)
        ->first();

        return response()->json([
            'data' => $data,
        ], 200);
    }

}