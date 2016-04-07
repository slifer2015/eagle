<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;

class EmailController extends Controller
{
    public function index(){
        $user=Auth::user();
        return view('general.emailConfirmation',compact('user'))->with(['title'=>'فعال سازی ایمیل']);
    }

    public function resend(){
        $user=Auth::user();
        if(!$user->confirmed){
            $new_code=str_random(30);
            $user->update(['confirmation_code'=>$new_code]);
            $input=$user->toArray();
            Mail::send('emails.welcome', ['user'=>$input], function ($message)use ($input)  {
                $message->to($input['email'])->subject('welcome to Namamooz');
            });
            Flash::success(trans('users.confirmationEmailResended'));
        }
        return redirect()->back();
    }

    public function check($confirmation_code){
        if(Auth::check()){
            $user=Auth::user();
        }else{
            $user=User::where('confirmation_code',$confirmation_code)->firstOrFail();
        }
        if(!$user->confirmed){ //check if the user has been already confirmed or not
            if($user->confirmation_code==$confirmation_code){
                $user->update(['confirmed'=>1]);
                Auth::login($user);
                Flash::success(trans('users.emailConfirmed'));
            }else{
                Flash::error(trans('users.emailCodeMismatch'));
            }
            return redirect(route('index'));
        }else{ //the user has been already confirmed
            return redirect(route('index'));
        }
    }
}
