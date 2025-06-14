<?php

namespace App\Http\Middleware;

use App\Events\EmailVerificationEvent;
use App\Mail\VerifyEmail;
use App\Models\GeneralSetting;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class UserStateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get requested route
        $route = $request->route();
        $endpoint = $route->uri();


        $user = auth()->user();
        $user = User::where('id', $user->id)->first();

        // Get site setting
        $setting = GeneralSetting::first();

        if ($setting->email_verification == true) {
            if ($user->otp_verified != true) {

                $otp = mt_rand(100000, 999999);
                $expiry = now()->addMinutes(10);

                User::where('id', $user->id)->update(
                    [
                        'otp' => $otp,
                        'otp_expiry' => $expiry,
                    ]
                );

                $eData = [
                    'email' => $user->email,
                    'otp' => $otp,
                ];

                event(new EmailVerificationEvent($eData));

                // Create token
                $token = $user->createToken('auth')->plainTextToken;

                return response()->json([
                    'status' => false,
                    'state' => 'otp_verification',
                    'data' => $user,
                    'message' => 'Verification email has been sent, please verify OTP.',
                    'response' => [
                        'token' => $token,
                    ]
                ], 400);
            } else {
                return $next($request);
            }
        }



        if ($endpoint == 'api/v1/complete-setup') {
            return $next($request);
        } else {
            if ($user->status == 'incomplete') {

                // Create token
                $token = $user->createToken('auth')->plainTextToken;

                return response()->json([
                    'state' => 'complete-setup',
                    'message' => 'Your profile is incomplete, please complete profile setup.',
                    'response' => [
                        'token' => $token,
                    ]
                ], 406);
            }
        }

        if ($user->status != 'approved') {
            return response()->json([
                'state' => 'blocked',
                'message' => 'Your account has been blocked, please contact with support',
                'block_reason' => $user->block_reason
            ], 406);
        }
        return $next($request);
    }
}
