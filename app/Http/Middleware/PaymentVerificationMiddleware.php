<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->acceptance_fee_status == 'PAID'){
            if(Auth::check() && Auth::user()->prospectus_fee_status == 'PAID'){
                if (Auth::check() && Auth::user()->department_fee_status == 'PAID') {      
                    if(Auth::check() && Auth::user()->school_fee_status == 'PAID'){
                        return $next($request);
                    }      
                    else{
                        return redirect('/unpaid');
                    }       
                }
                else{
                    return redirect('/unpaid');
                }
            }
            else{
                return redirect('/unpaid');
            }
        }
        else {
            return redirect('/acceptance_fee');
        }
    }
}
