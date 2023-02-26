<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardController extends Controller {
    
    public function index() {

        $data = DB::table('v_device_relay')
        ->orWhereNotNull('logs_id')
        ->orderBy('ftdevice_name','asc')
        ->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }
}