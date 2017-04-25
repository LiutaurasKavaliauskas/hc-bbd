<?php

namespace interactivesolutions\honeycombapps\app\http\middleware;

use Carbon\Carbon;
use HCLog;
use Closure;
use interactivesolutions\honeycombapps\app\models\apps\HCAppsTokens;

class HCAuthApps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Hc-Token');

        if (!$token)
            return HCLog::error('APP-001', trans(trans ("HCApps::apps_tokens.missing")));

        $record = HCAppsTokens::where('token', $token)->where('expires_at', '>=', Carbon::now())->first();

        if (!$record)
            return HCLog::error('APP-002', trans ("HCApps::apps_tokens.not_found"));

        //TODO add this value in hc:env command
        $extendLifeSpan = env('HC_API_TOKEN_LIFESPAN_EXPAND', 0);

        if ($extendLifeSpan > 0)
        {
            $expire_max = Carbon::now()->addMinutes($extendLifeSpan);
            $expire_at = new Carbon($record->expires_at);

            if ($expire_at < $expire_max)
                $record->update(['expires_at' => $expire_max]);
        }

        return $next($request);
    }
}
