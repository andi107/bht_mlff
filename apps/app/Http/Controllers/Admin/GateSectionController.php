<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hlp;

class GateSectionController extends Controller
{
    public function list(Request $request) {
        return view('pages.gatesection.list');
    }
}
