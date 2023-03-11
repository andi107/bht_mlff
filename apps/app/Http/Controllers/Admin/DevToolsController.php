<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hlp;
class DevToolsController extends Controller
{
    public function divice_live_js() {
        $res = Hlp::apiGet('/dashboard');
        return response()->json([
            'data' => $res,
        ]);
    }
    
    public function index() {
        return view("pages.devtools.resource_monitor");
    }

    public function devices_live() {
        return view("pages.devtools.devices_live");
    }
}
