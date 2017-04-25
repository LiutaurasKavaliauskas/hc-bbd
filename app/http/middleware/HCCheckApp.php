<?php

namespace app\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HCCheckApp
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
        $data = request()->only('app_id', 'secret');

        if (!auth()->guard('api-apps')->attempt($data))
            return response(['success' => false, 'message' => 'AUTH-002 - ' . trans('HCACL::users.errors.login')]);

        //redirect to intended url
       return response(['success' => true, 'redirectURL' => session('url.intended', url('/'))]);
    }
}
