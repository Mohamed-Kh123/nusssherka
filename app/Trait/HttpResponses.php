<?php 

namespace App\Trait;

trait HttpResponses {
    protected function success($data, $message = "", $code = 200)
    {
        return response()->json([
            'states' => "Request success",
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function error($data, $message="", $code)
    {
        return response()->json([
            'states' => "Error happend ..",
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}