<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
{
    
    public function handle(Request $request, Closure $next)
    {

        
        //dd(Auth::user()->id);
        // Check if the user is authenticated
        // if (Auth::check()) {
        //     // If the user is authenticated, check if they have a subscription
        //     if (Auth::user()->current_plan != 0) {
        //         // User has an active subscription, continue with the request
        //         return $next($request);
        //     } else {
        //         // User does not have an active subscription, redirect to the subscription page
        //         return redirect()->route('subscription');
        //     }
        // } else {
        //     // If the user is not authenticated, redirect to the login page
        //     return redirect()->route('login');
           
        // }

        return $next($request);
    }
}
