<?php

namespace App\Http\Controllers\Admin\Notifications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function getView()
    {
        return view('Admin/pages/Notifications/notifications');
    }

   public function triggerNotification(Request $req, $id = null)
    {
        $firebaseConfig = DB::table('firebase_config')->first();

        // Get all user tokens
        if ($id != null) {
            $user = User::find($id);
            if (!$user || !$user->fcm_token) {
                return back()->withErrors('User not found or FCM token missing.');
            }
            $userTokens = [$user->fcm_token];
        } else {
            $userTokens = array_filter(User::pluck('fcm_token')->all());
        }

        // Load the service account key JSON file
        $serviceAccountPath = storage_path('app/firebase/firebase-adminsdk.json');

        $client = new GoogleClient();
        $client->setAuthConfig($serviceAccountPath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

        // Replace with your Firebase project ID
        $projectId = 'luckybox-c333e';

        // Construct messages array
        foreach ($userTokens as $token) {
            $message = [
                'message' => [
                    'token' => $token,
                    'notification' => [
                        'title' => $req->title,
                        'body' => $req->body,
                    ],
                    'android' => [
                        'priority' => 'high',
                    ],
                    'apns' => [
                        'headers' => [
                            'apns-priority' => '10',
                        ],
                    ],
                ],
            ];

            $response = Http::withToken($accessToken)
                ->post("https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send", $message);

            if (!$response->successful()) {
                \Log::error('FCM send failed: ' . $response->body());
            }
        }

        return back()->withSuccess('Notification(s) sent using HTTP v1 API.');
    }


    public function push($title, $body, $token)
    {
        $serviceAccountPath = storage_path('app/firebase/firebase-adminsdk.json');

        $client = new \Google\Client();
        $client->setAuthConfig($serviceAccountPath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

        $projectId = 'your-firebase-project-id';

        $message = [
            'message' => [
                'token' => $token,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
            ],
        ];

        $response = Http::withToken($accessToken)
            ->post("https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send", $message);

        return response()->json([
            'message' => $response->successful() ? 'Notification sent' : 'Failed to send',
            'response' => $response->json()
        ]);
    }

    public function fcmView ()
    {
        $fcm = DB::table('firebase_config')->first();

        return view('Admin.pages.Notifications.fcm', ['firebase' => $fcm]);
    }

    public function fcmUpdate (Request $req)
    {

        DB::table('firebase_config')->update(
            [
                'server_key' => $req->fcm,
            ]
        );

        return redirect()->back()->withSuccess('FCM updated');

    }
}
