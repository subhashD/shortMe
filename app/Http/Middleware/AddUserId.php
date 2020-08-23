<?php

namespace App\Http\Middleware;

use Closure;

class AddUserId
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
        // dd($request->user());
        if(\Auth::user() !== null) {
            $request->request->add([
                'user_id' => \Auth::user()->id
            ]);
        }
        
        return $next($request);
    }
}
