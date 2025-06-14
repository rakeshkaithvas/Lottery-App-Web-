<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Package
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
                // Get the request path
        $path = $request->getPathInfo();

        $packageName = $request->header('Package-Name');

        $allowedPackageName = [config('logging.channels.registered.android'), config('logging.channels.registered.ios')];

        if (!in_array($packageName, $allowedPackageName)) {
            return response()->json(['status' => 'unauth', 'message' => 'Unauthorized. The license was registered with another package name, Contact with support.'], 401);
        }

         // Check if the request path ends with '/update'
        if (Str::endsWith($path, '/update')) {
            // If it ends with '/update', simply pass the request to the next middleware
            return $next($request);
        } else {
            if (!Config('logging.channels.registered.reg')) {
                return response()->json(['status' => 'unauth', 'message' => 'Please verify your app license before you use'], 401);
            }
        }

        return $next($request);
    }
}
