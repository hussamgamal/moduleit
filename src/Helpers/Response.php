<?php

namespace MshMsh\Helpers;

class Response
{
    public static array $response;

    public static function get($status, $message, $data)
    {
        self::$response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return Paginator::finalResponse(self::$response);
    }
}
