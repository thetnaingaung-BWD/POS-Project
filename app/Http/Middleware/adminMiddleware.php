<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(url()->current());  //URL
        // dd($request->route()->getName()); //URL Route Name
        if(!empty(Auth::user())){
            if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin'){
                // dd($request->route()->getName() == 'AuthLogin'  );

                if ($request->route()->getName() == 'AuthLogin' || $request->route()->getName() == 'AuthRegister' ) {
                    abort(404);
                }
                    return $next($request);



            }
            return back();
        }
        return $next($request);

    }
}
