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

    public function test() {
        $tes = DB::table('v_device_relay')
        ->orWhereNotNull('logs_id')
        ->first();
        
        $creat_at = Carbon::parse('2023-02-27 02:24:52')
        // ->createFromTimestampUTC(0)
        ->utcOffset(480);
        // $carbon = Carbon::createFromTimestampUTC(0)->utcOffset(0);
        // $resTes = $this->assertSame(1970, $carbon->year);
        $selTz = DB::table('v_device_relay')
        ->selectRaw("current_setting('TIMEZONE')")
        ->first();
        dd($creat_at,$selTz);
    }
}