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
        /* $ip = gethostbyname($request->server('HTTP_HOST'));
        $host = UISite::where([
            'host' => $ip
        ])->first();

        if(!$host) {
            return response('Access forbidden for this site', 403);
        } */

        $domainName = $request->server('SERVER_NAME');
        $host = UISite::where([
            'host' => $domainName
        ])->first();

        if($host && $host->num_shows >= 100000) {
            return response('Access forbidden: day limit is here.', 403);
        }

        return $next($request);

    }
}
