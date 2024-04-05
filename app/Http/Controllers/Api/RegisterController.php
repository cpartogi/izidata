<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    //

    public function store(Request $request)
    {
        if (!empty($request->json('email')) && !empty($request->json('password')) ) {
            $email = $request->json('email');
            $password = $request->json('password');


            //check if email exist
            $sqlc = "SELECT id FROM users where email = '".$email."'";
            $rc=DB::select($sqlc);
           

            if (count($rc) > 0)  {
                return response()->json([
                    "status" => "Conflict",
                    "statusCode" => 409,
                    "message" => "Email already exist",
                    "data" => null,
                ], 409);
    
            }    

             //insert to database
             $sqli = "INSERT INTO users (email, password) values ('".$email."', '".$password."')";
             DB::insert($sqli);


            //get id  of the user just registered 
            $sqls = "SELECT id from users where email='".$email."'";
            $rs=DB::select($sqls);
            $id=$rs[0]->id;

            $data["user_id"] = $id;

            return response()->json([
                "status" => "Success",
                "statusCode" => 200,
                "message" => "Success register",
                "data" => $data,
            ], 200);

        } else {
            return response()->json([
                "status" => "Bad Request",
                "statusCode" => 400,
                "message" => "Email and Password required",
                "data" => null,
            ], 400);
        }    
        

    }
}
