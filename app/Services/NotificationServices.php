<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationServices{
    public static function FireBaseNotification($userId,$productName)
    {
        $notification = new Notification();
        $notification->user_id = $userId;
        $notification->message = "Issue created ".$productName;
        $notification->save();

        $url = 'https://fcm.googleapis.com/fcm/send';
        $fcmTokens = User ::where('id',$userId)->whereNotNull('fcm_token')->pluck('fcm_token')->all();

        $SERVER_API_KEY = env('FIREBASE_SERVER_KEY');

        $data = [
            "registration_ids" => $fcmTokens,
            "notification" => [
                "title" => "Issue created ".$productName,
                "body" => '',
            ]
        ];

        $RESPONSE = json_encode($data);

        $headers = [
            'Authorization:key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        // CURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $RESPONSE);

        $output = curl_exec($ch);
        if ($output === FALSE) {
            die('Curl error: ' . curl_error($ch));
        }
        curl_close($ch);



    }
}
