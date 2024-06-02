<?php

namespace MshMsh\Helpers;

use MshMsh\Helpers\Response\ResponseFactory;

class ApiResponder
{
    static function get($message = '', $data = null, $status = true, $status_code = 200)
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

    public static function success($message = '', $data = null, $status = true)
    {
        return self::get($message, $data, $status, 200);
    }

    public static function error($message = '', $data = null, $status = false)
    {
        return self::get($message, $data, $status, 200);
    }
}
