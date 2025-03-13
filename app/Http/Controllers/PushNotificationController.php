<?php

namespace App\Http\Controllers;

use App\Helper\classes\FirebaseServices;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    protected $FirebaseServices;

    public function __construct(FirebaseServices $firebase)
    {
        $this->FirebaseServices = $firebase;
    }

    public function sendPushNotification(Request $request)
    {


        $title = $request->input('title');
        $body  = $request->input('body');
        $token = $request->input('token');

        if (!empty($title) && !empty($body) && !empty($token))
        {
            $this->FirebaseServices->sendNotificationToUser($token, $title, $body);
            return response()->json(['message' => 'Push notification sent successfully']);
        }


//        $firebase = (new Factory)->withServiceAccount(__DIR__.'/../../../halinaha-firebase.json');
//
//        $messaging = $firebase->createMessaging();
//
//
//        $message = CloudMessage::fromArray([
//            'notification' => [
//                'title' => 'Hello from Firebase!',
//                'body' => 'This is a test notification.'
//            ],
//            'topic' => 'global'
//        ]);
//        $messaging->send($message);

        return response()->json(['message' => 'an error occurred']);
    }
}
