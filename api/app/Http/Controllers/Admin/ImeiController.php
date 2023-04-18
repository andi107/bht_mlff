<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class ImeiController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list() {
        $data = DB::table('x_imei')
        ->get();
        return response()->json([
            'data' => $data
        ], 200);
    }
}