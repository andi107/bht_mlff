<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

use Illuminate\Contracts\Auth\Guard;
class DevToolsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function device_select() {
        $data = DB::table('x_devices')
        ->selectRaw("ftdevice_id as id, ftdevice_id || ' - ' || ftdevice_name as text")
        ->orderBy('ftdevice_name','asc')
        ->get();
        return response()->json([
            'data' => $data
        ], 200);
    }
}