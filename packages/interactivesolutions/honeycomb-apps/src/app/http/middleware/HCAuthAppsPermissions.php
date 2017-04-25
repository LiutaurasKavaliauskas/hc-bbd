<?php

namespace interactivesolutions\honeycombapps\app\http\middleware;

use Carbon\Carbon;
use HCLog;
use Closure;
use interactivesolutions\honeycombapps\app\models\apps\HCAppsTokens;

class HCAuthAppsPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $permission
     * @return mixed
     */
    public function handle($request, Closure $next, string $permission = '')
    {
        if (!$this->getTokenPermissions($request->header('Hc-Token'))->hasTokenPermission($permission))
            return HCLog::error('APP-003', trans ("HCApps::apps_tokens.access_denied"));

        return $next($request);
    }

    /**
     * @param $token
     * @return HCAppsTokens
     */
    public function getTokenPermissions ($token) : HCAppsTokens
    {
        return HCAppsTokens::where('token', $token)->first();
    }
}
