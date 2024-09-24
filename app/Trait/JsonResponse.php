<?php

namespace App\Trait;

use Throwable;

trait JsonResponse{

    public function successResponse($data = [], $message = "", $status = true, $code = 200 ){
        $responsePayload = [
            "status"  => $status,
            "code"    => $code,
            "message" => $message,
            "data"    => $data
        ];

        return response()->json($responsePayload, $code);
    }


    public function errorResponse($message = "Opps! Something Went Wrong",  $exception = null,$status = false, $code = 500, $isValidationError  = true ){

        $responsePayload = [
            'status' => $status,
            'code' => $code,
            'message' => $message,
            "error" => errorArray($exception),
        ];

        return response()->json($responsePayload, $code);
    }
}
