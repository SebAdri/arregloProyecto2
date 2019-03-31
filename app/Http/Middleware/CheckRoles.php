<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
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
        $roles = func_get_args();
        $roles = array_slice($roles, 2);
       //si tiene alguno de estos roles, lo dejamos pasar
        if (auth()->user()->hasPermission($roles)){
            return $next($request);
        }    
        if (auth()->check()) {
            return redirect(url()->previous());

        }else{
            return redirect('logout'); //si no, lo redireccionamos al home
        }
        // return redirect('login');
    }

}
