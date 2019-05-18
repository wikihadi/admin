<?php

namespace App\Http\Middleware;

use App\Status;
use Closure;
use Illuminate\Support\Facades\Auth;

class OffUser
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
        $test = Status::where('user_id',Auth::id())->where('status','off')->orWhere('status','on')->orderBy('created_at','desc')->first();
        if(empty($test->status) || $test->status == 'on'){
            return $next($request);

        }


        return redirect('home');
    }
}
