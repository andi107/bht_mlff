<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hlp;
class DashboardController extends Controller
{

    public function divice_map() {

        $res = Hlp::apiGet('/dashboard');
        return response()->json([
            'data' => $res,
        ]);
    }

    public function index() {
        return view('pages.dashboard');
    }
}
