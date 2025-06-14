<?php

namespace App\Http\Middleware;

use App\Models\GeneralSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get setting
        $setting = GeneralSetting::first();

        // Check if maintenance mode is enabled
        if ($setting->maintenance_mode) {
            return response()->json(
                [
                    'status' => 'maintenance',
                    'message' => $setting->maintenance_message,
                ],
                503
            );
        }
        return $next($request);
    }
}
