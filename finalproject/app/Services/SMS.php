<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SMS {

    public static function send($mobile, $msg, $type = 2)
    {
        return Http::get('http://hotsms.ps/sendbulksms.php', [
            'user_name' => config('services.hotsms.user'),
            'user_pass' => config('services.hotsms.pass'),
            'sender' => config('services.hotsms.sender'),
            'mobile' => $mobile,
            'type' => $type,
            'text' => $msg
        ]);
    }

}
