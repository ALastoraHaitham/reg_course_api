<?php

namespace App\traits;
trait ApiResponse
{
    function success_response($result,$code =200,$message ="Successful"){
        return response()->json(
            data: [
                "status" => true,
                "code" => $code,
                "message" => $message,
                "data" => $result
            ],
                status: $code
        );
    }

    function failled_response($result= null , $code =404,$message ="Failled"){
        return response()->json(
            data: [
                "status" => false,
                "code" => $code,
                "message" => $message,
                "data" => $result
            ],
                status: $code
        );
    }
}
?>