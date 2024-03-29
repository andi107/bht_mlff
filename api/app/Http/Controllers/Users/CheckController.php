<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $chkData = DB::table('users')
        ->where('uid','=', Auth::id())
        ->where('fnstatus','<>', 1)
        ->first();
        return response()->json([
            'data' => 'ok'
        ], 200);
    }

    public function go_logout(Request $request) {
        // dd($request);
        Auth::logout();
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

}