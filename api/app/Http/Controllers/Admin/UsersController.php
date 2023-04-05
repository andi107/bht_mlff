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
        ->selectRaw('uid,email,ftfirst_name,ftlast_name,created_at,updated_at,fnstatus')
        ->orderBy('created_at','desc')
        ->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'email' => 'required|max:100',
            'password' => 'required|max:100',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'status' => 'required|numeric'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $status = $request->input('status');
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
                'uid' => Str::uuid(),
                'email' => $email,
                'password' => Hash::make($password),
                'ftfirst_name' => $first_name,
                'ftlast_name' => $last_name,
                'created_at' => $dtnow,
                'updated_at' => $dtnow,
                'fnstatus' => $status
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
            'email' => 'required|max:100',
            'password' => 'required|max:100',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'status' => 'required|numeric'
        ]);
        $id = $request->input('id');
        $email = $request->input('email');
        $password = $request->input('password');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $status = $request->input('status');
        DB::beginTransaction();
        try {
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
                'email' => $email,
                'password' => Hash::make($password),
                'ftfirst_name' => $first_name,
                'ftlast_name' => $last_name,
                'updated_at' => $dtnow,
                'fnstatus' => $status
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

}