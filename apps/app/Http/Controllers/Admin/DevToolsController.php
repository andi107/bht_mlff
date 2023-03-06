<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DevToolsController extends Controller
{
    public function index() {

        return view("pages.devtools.resource_monitor");
    }
}
