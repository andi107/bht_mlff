<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    public function formindex() {
        return view('pages.geo.form', [
            'cfg' => [
                'title' => 'Add Geo Location'
            ],
        ]);
    }
}
