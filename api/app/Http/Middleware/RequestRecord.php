<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
// use App\Helpers\Notification;
use App\Helpers\Guard;
class RequestRecord
{
    
    public function handle($request, Closure $next) {

        if (env('APP_ENV') !== 'production') {
            return $next($request);
        }

        $_req_method = $request->method();
        
        $_isurl = URL::current();
        $dtnow = Carbon::now();
        $_isAuth = false;

        if (isset(Auth::user()->id)) {
            $_users_code = Auth::user()->id;
        }else{
            $_users_code = 0;
        }
        
        if (strtoupper($_req_method) == 'POST') {
            $_req_dump = json_encode($request->all());
            
            $_user_agent = request()->userAgent();
            $csrf = $request->input('_csrf');
            if (!$csrf) {
                return response()->json(['csrf' => ['The csrf field is required.']], 422);
            }
            if (str_contains($_isurl, '/api/a/auth')){
                $_isAuth = true;
                $username = $request->input('username');
                if (!$username) {
                    return response()->json(['username' => ['The username field is required.']], 422);
                }
                
                $validate = Guard::check_point($request->input('_csrf'),$username);
                
                $getUsernameWithoutLogin = DB::table('users')
                    ->where('username','=', $username)
                    ->first();
                    
                if ($getUsernameWithoutLogin) {
                    $_users_code = $getUsernameWithoutLogin->id;
                }
            }else{
                $validate = Guard::check_point($csrf);
            }
            if (isset($validate->error)){ return response()->json([ 'error' => $validate->error ], 404); }

            if (!str_contains($_isurl, env("APP_URL"))){
                $_isurl = "External Browser.";
            }
            
            // DB::table('x_log_request')
            //     ->insert([
            //         'uuid_users_code' => $_users_code,
            //         'ftmethod' => $_req_method,
            //         'ftapi_url_action' => $_isurl,
            //         'ftapi_curl_json' => $_req_dump,
            //         'ftapi_user_agent' => $_user_agent,
            //         'ftclient_host' => $validate->host,
            //         'ftclient_public_ip' => $validate->public_ip,
            //         'ftclient_browser' => $validate->browser,
            //         'ftclient_devices' => $validate->devices,
            //         'ftclient_os' => $validate->os,
            //         'ftclient_user_agent' => $validate->user_agent,
            //         'ftclient_url' => $validate->url,
            //         'created_at' => $dtnow,
            //         'ftgeo_latitude' => $validate->geo_latitude,
            //         'ftgeo_longitude' => $validate->geo_longitude
            //     ]);
        }

        if ($_isAuth) {
            $request->merge(array("password" => $validate->message));
        }
        return $next($request);
    }

}