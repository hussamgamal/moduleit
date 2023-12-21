<?php

namespace MshMsh\Helpers;

use MshMsh\Helpers\Response\ResponseFactory;

class ApiResponsder
{
    static function get($message = '' , $data = null , $status = true , $status_code = 200)
    {
        if ($status_code == 422) {
            if ($data && count($data)) {
                $message = $data[array_key_first($data)];
                $data = null;
            }
        }
        
        $response = ResponseFactory::get($status, $message, $data);
        
        $status_code = 200;
        
        return response()->json($response, $status_code);
    }
}
