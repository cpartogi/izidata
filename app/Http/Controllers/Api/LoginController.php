<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    public function store(Request $request)
    {
        if (!empty($request->json('email')) && !empty($request->json('password')) ) {
            $email = $request->json('email');
            $password = $request->json('password');

            //check if login valid
            $user = DB::table('users')
                ->select('id')
                ->where('email', $email)
                ->where('password', $password)
                ->first();

            if (!$user)  {
                return response()->json([
                    "status" => "Forbidden",
                    "status_code" => 403,
                    "message" => "Login failed",
                    "data" => null,
                ], 403);
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
                "data" => $data,
            ], 200);

        } else {
            return response()->json([
                "status" => "Bad Request",
                "status_code" => 400,
                "message" => "Email and Password required",
                "data" => null,
            ], 400);
        }    
        

    }
}
