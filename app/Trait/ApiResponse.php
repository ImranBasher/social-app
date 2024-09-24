<?php

namespace App\Trait;

use Throwable;

trait ApiResponse{

    public function successResponse($data = [], $message = "", $status = true, $code = 200,    ){
        $responsePayload = [
            "status" => $status,
            "code" =>$code,
            "message" => $message,
            "data"  => $data
        ];

        return response()->json($responsePayload, $code);
    }


    public function errorResponse($message = "Opps! Something Went Wrong", Throwable $exception = null, $code = 500, $isValidationError  = true ){



        $responsePayload = [
            'status' => 'error',
            'messsage' => $message,
        ];

        if($exception){

            $responsePayload['error'] = [
                'message' => $exception->getMessage()
            ];
        }

        return response()->json($responsePayload, $code);
    }
}
