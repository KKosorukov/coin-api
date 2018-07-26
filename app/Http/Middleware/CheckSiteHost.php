<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use App\Models\UI\Site as UISite;

class CheckSiteHost
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
        $ip = $request->server('REMOTE_ADDR');
        $host = UISite::where([
            'host' => $ip
        ])->get();

        if(!$host) {
            return response('Access forbidden.', 403);
        }

        return $next($request);
    }
}
