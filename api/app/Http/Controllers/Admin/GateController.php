<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Str;
class GateController extends Controller {

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function create(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:100',
            'section' => 'required|max:255',
            'description' => 'max:255',
            'lat' => 'required',
            'lon' => 'required',
            'payment_type' => 'required|numeric',
        ]);

        $name = $request->input('name');
        $section = $request->input('section');
        $description = $request->input('description');
        $lat = $request->input('lat');
        $lon = $request->input('lon');
        $payment_type = $request->input('payment_type');

        DB::beginTransaction();
        // try {
            $dtnow = Carbon::now();

            $chkSection = DB::table('x_gate_point')
            ->selectRaw('ftsection as id')
            ->where('ftsection','=', $section)
            ->groupBy('ftsection')
            ->first();
            $chkName = DB::table('x_gate_point')
            ->where('ftname','=',$name)
            ->first();
            if ($chkName) {
                DB::rollback();
                return response()->json([
                    'error' => $name.' already exists.',
                ], 404);
            }else if (!$chkSection) {
                DB::rollback();
                return response()->json([
                    'error' => 'Section not found.',
                ], 404);
            }
            DB::table('x_gate_point')
            ->insert([
                'id' => Str::uuid(),
                'ftname' => $name,
                'ftsection' => $section,
                'ftdescription' => $description,
                'fflat' => $lat,
                'fflon' => $lon,
                'fnpayment_type' => $payment_type,
                'created_at' => $dtnow
            ]);
            DB::commit();
            return response()->json([], 200);
        // } catch (\Throwable $th) {
            // DB::rollback();
            // return response()->json([
            //     'error' => 'Internal Server Error.',
            // ], 500)
            //     ->header('X-Content-Type-Options', 'nosniff')
            //     ->header('X-Frame-Options', 'DENY')
            //     ->header('X-XSS-Protection', '1; mode=block')
            //     ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
        // }
    }
}