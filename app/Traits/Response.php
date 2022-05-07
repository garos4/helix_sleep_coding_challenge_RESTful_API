<?php

namespace App\Traits;


trait Response
{
    public function successResponse($data)
    {
        $response = [
            'status' => 'success',
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    public function deleteResponse($message)
    {

        $response = [
            'status' => 'success',
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    public function errorResponse($errorMessage)
    {
        $response = [
            'status' => 'error',
            'message' => $errorMessage
        ];

        return response()->json($response, 422);
    }

    public function alreadyExistsResponse(){
        $response = [
            'status' => 'error',
            'message' => 'User has already been attached'
        ];

        return response()->json($response, 422);
    }

    public function notFoundResponse()
    {

        $response = [
            'status' => 'error',
            'data' => 'Resource Not Found',
            'message' => 'Not Found'
        ];

        return response()->json($response, 404);
    }
}
