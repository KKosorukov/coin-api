<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\UI\Site as UISite;

class ShowsLimit
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
        ])->first();

        if($host->num_shows >= 100000) {
            return response('Access forbidden: day limit is here.', 403);
        }

        return $next($request);
    }
}
