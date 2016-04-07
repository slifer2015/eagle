<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class EmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=$request->user();
        if(!$user->confirmed){
            $diff=Carbon::parse($user->created_at)->diffInDays();
            if($diff>30){
                //user cant login and he/she must activate his/her email
                return redirect(url('/email'));
            }
        }else{
            //everything looks good
        }
        return $next($request);
    }
}
