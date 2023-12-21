<?php

namespace MshMsh\Helpers\Response;

class ResponseFactory
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
