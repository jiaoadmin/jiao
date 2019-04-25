<?php

namespace App\Http\Middleware;

use Closure;
use App\Tools\WecharJssdk;

class Jssdk
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
        $jssdk = new WecharJssdk();
        $signPackage = $jssdk->GetSignPackage();
        $data=[
           'signPackage'=>$signPackage
        ];
        $request->merge($data);//merge()合并参数
        return $next($request);
    }
}
