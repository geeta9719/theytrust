<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $uri = explode('/',$_SERVER['REQUEST_URI']);
        
        //dd($uri);
        //dd($request->expectsJson());
        
        if (! $request->expectsJson()) 
        {
            if(strtolower( $uri[1]) === 'admin' )
            {
                return route('login');
            }
            
            return route('auth.linkedin');
        }
    }
}
