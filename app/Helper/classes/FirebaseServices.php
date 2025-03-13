<?php

namespace App\Helper\classes;

use App\Models\Notifications;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseServices
{
    protected $messages;

    public function __construct()
    {
        $this->messages = (new Factory)->withServiceAccount(__DIR__.'/../../../resources/credentials/firebase_credentials.json')
            ->createMessaging();

    }

    public function sendNotificationToUser(String $token, String $title, String $body,array $data =[])
    {
        try
        {
            $notification = Notification::create($title, $body);

            $message = CloudMessage::new()->withNotification($notification);

            $this->messages->sendMulticast($message, $token);

        }catch (\Exception $exception)
        {
            Log::error('An error in FCM notifications '.$exception->getMessage());
        }
    }

}
