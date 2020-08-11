<?php


namespace App\Traits;


trait ApiResponser
{
    protected function successResponse($data,$message = null,$code = null){
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ],$code);
    }

    protected function errorResponse($message = null, $code)
    {
        return response()->json([
            'status'=>'Error',
            'message' => $message,
            'data' => null
        ], $code);
    }
}
