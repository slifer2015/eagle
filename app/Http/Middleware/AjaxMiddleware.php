<?php

namespace App\Http\Middleware;

use Closure;
use Laracasts\Flash\Flash;

class AjaxMiddleware
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
        if($request->ajax()){
            return $next($request);
        }else{
            Flash::error('not ajax request');
            return redirect()->back();
        }

    }
}
