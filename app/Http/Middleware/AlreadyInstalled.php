<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class AlreadyInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (
            config('database.connections.mysql.host')
            && config('database.connections.mysql.username')
            && config('database.connections.mysql.database')
            && config('logging.channels.registered.android')
            && config('logging.channels.registered.ios')
            && config('app.license_key')
            && config('app.pw_token')
            && config('app.installed') === true
        ) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
