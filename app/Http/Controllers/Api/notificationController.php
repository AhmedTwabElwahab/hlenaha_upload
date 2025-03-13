<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\Request;

class notificationController extends BaseController
{


    public function getNotifications(Request $request)
    {
        if (!$request->has('uid'))
        {
            return $this->failed('uid is required.');
        }

        $uid = $request->input('uid');
        $notifications = Notifications::where('uid', $uid)->get();
        return $this->sendResponse($notifications->toArray(),'Notifications retrieved successfully.');
    }


    public function unreadNotifications(Request $request)
    {
        if (!$request->has('uid'))
        {
            return $this->failed('uid is required.');
        }

        $uid = $request->input('uid');
        $notifications = Notifications::where('uid', $uid)->where('read', false)->get();
        return $this->sendResponse($notifications->toArray(),'Notifications retrieved successfully.');
    }
    public function read(Request $request)
    {
        if (!$request->has('uid'))
        {
            return $this->failed('uid is required.');
        }

        $uid = $request->input('uid');
        $notifications = Notifications::where('uid', $uid)->where('read', false)->get();

        foreach ($notifications as $notification)
        {
            $notification->read = true;
            $notification->read_at = now();
            $notification->save();
        }

        return $this->success('Notifications read successfully.');
    }
}
