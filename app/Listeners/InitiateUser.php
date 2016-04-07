<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class InitiateUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $user=$event->user;
        File::makeDirectory(public_path().'/img/files/'.$user->id,0775,true,true);
        Mail::send('emails.welcome',['user'=>$user],function($msg) use ($user){
            $msg->from('info@namamooz.com','Namamooz');
            $msg->to($user['email'],$user->full_name)->subject('Welcome To Namamooz');
        });

    }
}
