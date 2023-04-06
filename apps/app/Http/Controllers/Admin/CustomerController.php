<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hlp;
class CustomerController extends Controller
{

    public function list_js() {
        $res = Hlp::apiGet('/user');
        if (!$res) {
            return response()->json([], 404);
        }
        return response()->json([
            'data' => $res->data
        ], 200);
    }

    public function list() {
        return view('pages.customer.list');
    }

    public function create(Request $request) {
        return view('pages.customer.form',[
            'cfg' => [
                'title' => 'Add New User'
            ],
        ]);
    }

    public function detail($uid) {
        $res = Hlp::apiGet('/user/d/'. $uid);
        return view('pages.customer.form',[
            'cfg' => [
                'title' => 'User Detail',
            ],
            'd' => $res->data
        ]);
    }
}
