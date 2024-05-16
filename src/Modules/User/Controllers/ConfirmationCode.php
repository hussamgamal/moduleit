<?php

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\Models\User;

class ConfirmationCode extends Controller
{
    public static function send($user)
    {
        $code = self::code($user);
        send_sms($user->mobile, $code['message']);
        return $code['code'];
    }

    public static function sendMail($user)
    {
        $code = self::code($user);
        $message = $code['message'];
        $code = $code['code'];
        return $code;
    }

    public static function code($user)
    {
        $code = rand(100000, 999999);
        $code = 123456;
        $user->token()->create(['token' => $code]);
        $message = __('Your confirmation code is : ' . $code);
        return get_defined_vars();
    }
}
