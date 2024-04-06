<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        if (!empty($request->json('email')) && !empty($request->json('password')) ) {
            $email = $request->json('email');
            $password = $request->json('password');

            //$hashPassword = Hash::make($password);

            //check if login valid
            $user = DB::table('users')
                ->select('id', 'password')
                ->where('email', $email)
                ->first();

            if (!$user)  {
                return response()->json([
                    "status" => "Not Found",
                    "status_code" => 404,
                    "message" => "email not found",
                    "timestamp" => Carbon::now('UTC')->toIso8601String(),
                    "data" => null,
                ], 404);
            }    

            if(!Hash::check($password, $user->password)){
                return response()->json([
                    "status" => "Bad Request",
                    "status_code" => 400,
                    "message" => "password not match",
                    "timestamp" => Carbon::now('UTC')->toIso8601String(),
                    "data" => null,
                ], 400);
            }    

            //generate token
            $id=$user->id;
            $token = md5(time().$id.$email);

            //update token to database
            DB::table('users')
                ->where('id', $id)
                ->update(['token' => $token]);

            $data["token"] = $token;

            return response()->json([
                "status" => "Success",
                "status_code" => 200,
                "message" => "Success Login",
                "timestamp" => Carbon::now('UTC')->toIso8601String(),
                "data" => $data,
            ], 200);

        } else {
            return response()->json([
                "status" => "Bad Request",
                "status_code" => 400,
                "message" => "Email and Password required",
                "timestamp" => Carbon::now('UTC')->toIso8601String(),
                "data" => null,
            ], 400);
        }    
        

    }
}
