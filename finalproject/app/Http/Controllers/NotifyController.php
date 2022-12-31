<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\AA;
use App\Notifications\TestNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Http;

class NotifyController extends Controller
{
    public function send_sms()
    {
        $res = Http::get('http://hotsms.ps/sendbulksms.php', [
            'user_name' => 'test7',
            'user_pass' => '8727591',
            'sender' => 'test',
            'mobile' => '0592418889',
            'type' => 2,
            'text' => 'Welcome From We Start جديد $'
        ]);

        dd($res->body());
    }


    public function send_notify()
    {
        $user = User::find(1);
        $user->notify( new TestNotification() );
    }

    public function read_notify()
    {
        $user = User::find(1);
        return view('notifications', compact('user'));
    }

    public function notify($id)
    {
        // DatabaseNotification
        $user = User::find(1);
        $notify = $user->notifications->find($id);
        $notify->markAsRead();

        return redirect($notify->data['url']);

    }
}
