<?php

namespace App\Http\Controllers\API\Users;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Events\PasswordChangedEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\EmailVerificationEvent;
use App\Models\Referral;
use App\Models\ReferSetting;
use App\Models\WalletTransaction;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function register(Request $req)
    {
        // Get site setting
        $setting = GeneralSetting::first();

        // Get refer setting
        $referSetting = ReferSetting::first();

        // Check if register is off
        if ($setting->user_registration == false)
        {
            return response()->json(
                [
                    'message' => 'User registration is curretly unavailable',
                ], 400,
            );
        }

        // Validate Data
        $req->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|unique:users,phone',
            'name' => 'required',
            'device_token' => 'required',
            'referrer_code' => 'nullable|exists:users,refer_code'
        ]);

        $otp = mt_rand(100000, 999999);
        $expiry = now()->addMinutes(10);

        do {
            $referCode = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        } while (User::where('refer_code', $referCode)->exists());

        // Create User
        $user = User::create(
            [
                'email' => $req->email,
                'password' => bcrypt($req->password),
                'fcm_token' => $req->device_token,
                'phone' => $req->phone,
                'name' => $req->name,
                'balance' => 0,
                'otp' => $otp,
                'refer_code' => $referCode,
                'status' => 'approved',
                'user_status'=>'normal',
                'otp_expiry' => $expiry,
            ]
        );

        // Check if verification if on
        if ($setting->email_verification == true) {
            $eData = [
                'email' => $user->email,
                'otp' => $otp,
            ];

            event(new EmailVerificationEvent($eData));
        }

        // If a referrer code is provided, create a referral record
        if ($req->has('referrer_code')) {
            $referrer = User::where('refer_code', $req->referrer_code)->first();
            if ($referrer) {
                Referral::create([
                    'referrer_id' => $referrer->id,
                    'referred_id' => $user->id,
                ]);
            }

            if ($referSetting->joining_bonus) {
                User::where('refer_code', $req->referrer_code)->increment('balance', $referSetting->joining_bonus_amount);
            }
        }

        // Create Token
        $token = $user->createToken('auth')->plainTextToken;

          // Create a  Qr Code
           // After creating the user
            $qrContent = 'USER_ID: ' . $user->id . ' | NAME: ' . $user->name; // You can customize
            $qrFileName = 'qr_' . Str::random(10) . '.png';
            $qrPath = public_path('user_qrcodes/' . $qrFileName);

            // Create directory if not exists
            if (!file_exists(public_path('user_qrcodes'))) {
                mkdir(public_path('user_qrcodes'), 0777, true);
            }
           
            // Generate and save QR code
            QrCode::format('png')->size(300)->generate($qrContent, $qrPath);

            // Save filename in user table (you must have `user_qr` column in `users` table)
            $user->user_qr = $qrFileName;
            $user->save();

         // Code  End for  Create  Code 
        // Return Response
        $message = 'User successfully registered!';
        return response()->json([
            'state' => 'success',
            'response' => [
                'token' => $token,
                'data' => $user,
                'state' => $setting->email_verification == true ? 'otp_verification' : 'home',
            ],
            'message' => $message,
        ], 200);
    }

    public function resendOtp(Request $req)
    {
        $req->validate([
            'email' => 'required|exists:users,email',
        ]);

        $user = User::where('email', $req->email)->first();


        $otp = mt_rand(100000, 999999);
        $expiry = now()->addMinutes(10);

        $user->update([
            'otp' => $otp,
            'otp_expiry' => $expiry,
        ]);

        $eData = [
            'email' => $user->email,
            'otp' => $otp,
        ];

        // Create Token
        $token = $user->createToken('auth')->plainTextToken;

        event(new EmailVerificationEvent($eData));

        // Return Response
        return response()->json([
            'state' => 'success',
            'message' => 'OTP sent success!',
            'token' => $token,
        ], 200);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'otp' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if ($user->otp !== $request->otp) {
            return response()->json(['message' => 'Invalid OTP.'], 400);
        }

        if ($user->otp_expiry < now()) {
            return response()->json(['message' => 'OTP expired.'], 400);
        }

        if (!$request->isReset) {
            $user->update(['otp_verified' => true]);
        }

        return response()->json(['message' => 'OTP verified successfully.']);
    }

    public function forgetPassword(Request $req)
    {
        $validated = $req->validate([
            'email' => 'required',
            'email*' => 'exists:users'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $otp = mt_rand(100000, 999999);
        $expiry = now()->addMinutes(10);

        $user->update([
            'otp' => $otp,
            'otp_expiry' => $expiry,
        ]);

        $eData = [
            'email' => $user->email,
            'otp' => $otp,
        ];

        // Create Token
        $token = $user->createToken('auth')->plainTextToken;

        event(new EmailVerificationEvent($eData));

        // Return Response
        return response()->json([
            'state' => 'success',
            'message' => 'OTP sent success!',
            'token' => $token,
        ], 200);
    }

    public function resetPassword(Request $req)
    {
        $req->validate(
            [
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|same:new_password',
            ]
        );

        // Get User
        $user = User::where('id', auth()->user()->id)->first();

        // Update Password
        $user->update([
            'password' => bcrypt($req->new_password),
        ]);

        event(new PasswordChangedEvent($user->email));

        // Return Response
        return response()->json([
            'state' => 'success',
            'message' => 'Password recovery successful!',
        ], 200);
    }

    public function login(Request $req)
    {
        $req->validate([
            'phone' => 'required',
            'password' => 'required',
            'device_token' => 'required'
        ]);

        if (Auth::attempt($req->only('phone', 'password'))) {
            $user = User::where('id', auth()->user()->id)->first();

            // Get site setting
            $setting = GeneralSetting::first();

            // Check if verification if on
            if ($setting->email_verification == true) {
                // Check if otp not verified send otp
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
                        'message' => 'Verification email has been sent, please verify OTP.',
                        'data' => $user,
                        'response' => [
                            'token' => $token,
                        ]
                    ], 400);
                } else {
                    if ($user->status == 'approved') {

                        // Store Or Update Device Token
                        $user->update([
                            'fcm_token' => $req->device_token
                        ]);

                        $token = $user->createToken('auth')->plainTextToken;

                        $user = User::where('id', $user->id)->first();

                        return response()->json([
                            'response' => [
                                'token' => $token,
                                'data' => $user,
                            ],
                            'message' => 'User successfully logged in',
                        ], 200);
                    } else if ($user->status == 'blocked') {
                        return response()->json([
                            'state' => 'blocked',
                            'message' => 'Your account has been blocked, please contact with support',
                            'block_reason' => $user->block_reason
                        ], 406);
                    } else {
                        return response()->json([
                            'state' => 'blocked',
                            'message' => 'Your account has been blocked, please contact with support',
                            'block_reason' => $user->block_reason
                        ], 406);
                    }
                }
            } else {
                if ($user->status == 'approved') {

                    // Store Or Update Device Token
                    $user->update([
                        'fcm_token' => $req->device_token
                    ]);

                    $token = $user->createToken('auth')->plainTextToken;

                    $user = User::where('id', $user->id)->first();

                    return response()->json([
                        'response' => [
                            'token' => $token,
                            'data' => $user,
                        ],
                        'message' => 'User successfully logged in',
                    ], 200);
                } else if ($user->status == 'blocked') {
                    return response()->json([
                        'state' => 'blocked',
                        'message' => 'Your account has been blocked, please contact with support',
                        'block_reason' => $user->block_reason
                    ], 406);
                } else {
                    return response()->json([
                        'state' => 'blocked',
                        'message' => 'Your account has been blocked, please contact with support',
                        'block_reason' => $user->block_reason
                    ], 406);
                }
            }
        } else {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 400);
        }
    }

    public function logout()
    {
        $user = User::where('id', auth()->id())->first();
        // Delete all token
        $user->tokens()->delete();
        // return
        return response()->json(['message' => 'User logout successful']);
    }

    public function getReferrals()
    {
        // Retrieve the user
        $user = User::findOrFail(auth()->user()->id);

        // Retrieve all referrals made by this user
        $referrals = $user->referrals;

        // Extract the referred users from the referrals
        $referredUsers = $referrals->map(function ($referral) {
            // printf($referral->refferer);
            return $referral->refferer;
        });

        return $referredUsers;
    }

    public function wallettransfer(Request $req)
    {
        // Validate the request
        $req->validate([
            'receiver_id' => 'required|exists:users,id|different:'.auth()->id(),
            'amount' => 'required|numeric|min:1',
            'inv_amount' => 'numeric|min:0',
            
        ]);
        // Retrieve sender
        $sender  = User::findOrFail(auth()->user()->id);
        if (!$sender) {
                return response()->json(['message' => 'Unauthenticated'], 401);
        }
        $receiver = User::find($req->receiver_id);
        $amount = $req->amount;
        
        // Check if sender has sufficient balance
        if ($sender->balance >= $amount) {
            DB::beginTransaction();
             try {
                // Deduct amount from sender
                $sender->balance -= $amount;
                $sender->save();
                 // Add amount to receiver
                $receiver->balance += $amount;
                $receiver->save();

                // Optional: Store transaction log
                WalletTransaction::create([
                    'sender_id' => $sender->id,
                    'receiver_id' => $receiver->id,
                    'amount' => $amount,
                    'inv_amount' => $req->inv_amount,
                    'type' => 'transfer',
                    'comments' => $req->comments,
                    'status' => 'completed',
                ]);
               
                DB::commit();
                return response()->json([
                    'message' => 'Amount transferred successfully',
                    'sender_balance' => $sender->balance,
                    'receiver_balance' => $receiver->balance,
                ], 200);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => 'Transfer failed', 'error' => $e->getMessage()], 500);
            }

        } else {
            return response()->json(['message' => 'Sender has insufficient balance'], 400);
        }
    }

    public function shopsusers(Request $request)
{
    try {
         $baseUrl = config('app.url'); // Base app URL

        // Start query with approved and non-null shop_name
        $query = User::where('status', 'approved')
            ->whereNotNull('shop_name')
            ->select('shop_name', 'shop_image', 'shop_category', 'shop_address', 'discount');

        // If search parameter exists, filter by shop_name or shop_address
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('shop_name', 'like', "%{$search}%")
                  ->orWhere('shop_address', 'like', "%{$search}%");
            });
        }

        // Get results
        $users = $query->get();

        // Add full image URL
        $users->transform(function ($user) {
        $user->shop_image = $user->shop_image ? asset($user->shop_image) : null;
    
         return $user;
    });
         return response()->json($users);
    } catch (\Exception $e) {
        Log::error('Error fetching active users: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong while fetching active users.'
        ], 500);
    }
}

public function walletHistory(Request $request)
{
    $userId = auth()->id();

    if (!$userId) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized',
        ], 401);
    }

    $transactions = WalletTransaction::with(['sender', 'receiver']) // eager load sender & receiver
        ->where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->orWhere('receiver_id', $userId);
        })
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($txn) use ($userId) {
            return [
                'id' => (int)$txn->id,
                'type' => $txn->sender_id == $userId ? 'Sent' : 'Received',
                'amount' => $txn->amount,
                'inv_amount' => $txn->inv_amount,
                'from_user_id' => (int)$txn->sender_id,
                'from_user_name' => optional($txn->sender)->name,
                'to_user_id' => (int)$txn->receiver_id,
                'to_user_name' => optional($txn->receiver)->name,
                'comments' => $txn->comments,
                'status' => $txn->status,
                'timestamp' => $txn->created_at->toDateTimeString(),
            ];
        });

    return response()->json($transactions);
   }
}
