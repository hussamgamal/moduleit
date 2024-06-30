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
        return response()->json($response, $status_code);
    }

    public static function make($data = null, $message = '', $code = 200)
    {
        return self::get(
            $message,
            $data,
            in_array($code, self::successCode()),
            $code,
        );
    }
    public static function successCode()
    {
        return [
            200,
            201,
            202,
            203,
            204,
            302,
        ];
    }
    public static function success($message = '', $data = null)
    {
        return self::make($message, $data);
    }

    public static function error($message = '', $data = null)
    {
        return self::make($message, $data, 400);
    }

    public static function loaded($data = null,$code = 200,$message = "Loaded Successfully")
    {
        return self::make($data, __($message),$code);
    }

    public static function created($data = null,$message = "Created Successfully",$code = 201)
    {
        return self::make($data,__($message), $code);
    }

    public static function failed($message, $code = 400)
    {
        return self::make(null, $message, $code);
    }

    public static function updated($data = null,$code = 202,$message = 'Updated Successfully')
    {
        return self::make($data, __($message),$code);
    }

    public static function deleted($code = 200,$message = 'Deleted Successfully')
    {
        return self::make(null, __($message),$code);
    }

    public static function notFound()
    {
        return self::make(null, __('Not Found'), 404);
    }

    public static function alreadyExists($record)
    {
        return self::make(null, __('Already Exists', ['attr' => $record]), 404);
    }
}
