<?php
// app/Http/Middleware/DemoModeMiddleware.php

namespace App\Http\Middleware;

use Closure;

class DemoMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if demo mode is enabled (you can define this in your config or environment variables)
        $demoMode = config('app.demo_mode', false);

        // If demo mode is enabled, restrict access to certain routes
        if ($demoMode) {
            // Check if the request method is GET (read-only)
            if ($request->method() !== 'GET') {
                // Return a response indicating that the action is not allowed in demo mode
                return redirect()->back()->withSuccess('Demo mode: Data manipulation is not allowed.');
            }
        }

        return $next($request);
    }
}

?>
