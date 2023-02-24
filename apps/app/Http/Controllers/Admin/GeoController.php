<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Hlp;
use Illuminate\Support\Facades\Validator;
class GeoController extends Controller
{
    public function create_update(Request $request) {
        $validator = Validator::make($request->all(), [
            'txtName' => 'required',
            'txtAddress' => 'required',
            'polygon_point' => 'required',
            'geo_type' => 'required'
            // 'status' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 442,
                'msg' => $validator->messages()->first(),
            ]);
        }
        $res = $this->create($request);

        return response()->json([
            'msg' => $res
        ]);
    }

    function create($re) {
        // _token', $("input[name=_token]").val());
        // fd.append('txtName', $("input[name=txtName]").val());
        // fd.append('txtaddress'
        // $txtName = $request->input('txtName');
        // $txtAddress = $request->input('txtAddress');
        // $polygon_point = $request->input('polygon_point');
        $body = [
            'id' => $re->input('id'),
            'geo_name' => $re->input('txtName'),
            'geo_address' => $re->input('txtAddress'),
            'geo_type' => $re->input('geo_type'),
            'polygon_point' => $re->input('polygon_point'),
            'status' => 1
        ];
        return $body;
        $r = Hlp::apiPost('/geo', $body);
        $res = $r->object();
        if (isset($res->error)) {
            if ($res->error == "Unauthorized") { // Check Auth
                return 'Sesi login telah habis, mohon untuk login kembali.';
            } else {
                return [
                    'id' => 'new',
                    'obj' => $res->error,
                    'code' => 404
                ];
            }
        }
        return [
            'obj' => $r->object(),
            'code' => $r->getStatusCode()
        ];
    }

    public function formindex() {
        return view('pages.geo.form', [
            'cfg' => [
                'id' => Str::uuid(),
                'title' => 'Add Geo Location'
            ],
        ]);
    }
}
