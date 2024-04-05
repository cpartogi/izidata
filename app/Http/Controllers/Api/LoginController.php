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
            $sqlc = "SELECT id FROM users where email = '".$email."' and password='".$password."' ";
            $rc=DB::select($sqlc);
           
            if (count($rc) == 0)  {
                return response()->json([
                    "status" => "Forbidden",
                    "status_code" => 403,
                    "message" => "Login failed",
                    "data" => null,
                ], 403);
            }    

            //generate token
            $id=$rc[0]->id;
            $token = md5(time().$id.$email);

            //update token to database
            $sqlu = "UPDATE users set token = '".$token."' where id = ".$id;
            DB::update($sqlu);

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
