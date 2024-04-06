<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GetTransactionController extends Controller
{
    //
    public function store(Request $request)
    {
        if (!empty($request->json('page')) ) {
            
            $page = $request->json('page');
            $limit = env('PAGE_SIZE');
            $offset = $limit * ($page - 1);


            //get data
            $sql = "select users.id , users.email , balance.amount_available , transaction.trx_id , transaction.amount, transaction.created_at from users 
            left join balance on balance.user_id =  users.id 
            left join transaction on transaction.user_id = users.id 
            order by users.id, transaction.created_at limit ".$limit." offset ".$offset." ";
            $rs=DB::select($sql);
            

            $data = [];

            foreach ($rs as $rs_) {
                $userId = $rs_->id;
                $email = $rs_->email;
                $amountAvailable = $rs_->amount_available;
                $trxId = $rs_->trx_id;
                $amount = $rs_->amount;
                $date = $rs_->created_at;

                if (!isset($data[$userId])) {
                    $data[$userId] = [
                        'user_id' => $userId,
                        'email' => $email,
                        'balance' => $amountAvailable,
                        'transactions' => [],
                    ];
                }

                if (!empty($trxId)) {
                    $data[$userId]['transactions'][] = [
                        'trx_id' => $trxId,
                        'amount' => $amount,
                        'date' => $date,
                    ];
                }
            }

            $data = array_values($data);

            return response()->json([
                "status" => "Success",
                "status_code" => 200,
                "message" => "Success get data",
                "timestamp" => Carbon::now('UTC')->toIso8601String(),
                "data" => $data,
            ], 200);

        } else {
            return response()->json([
                "status" => "Bad Request",
                "status_code" => 400,
                "message" => "page required",
                "timestamp" => Carbon::now('UTC')->toIso8601String(),
                "data" => null,
            ], 400);
        }    
        

    }
}
