<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Models\salesPerson;


use Illuminate\Http\Request;

class UserAuth
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
        if($request->session()->has('salesPerson')){
            $id = session('salesPerson')['id'];
            $salesPerson = salesPerson::find($id);
            if($salesPerson){
                
              }else{
                session()->forget('salesPerson');
                return redirect('/sales-person');
              }
        }
        return $next($request);
    }
}
