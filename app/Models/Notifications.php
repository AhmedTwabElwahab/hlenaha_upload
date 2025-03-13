<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Notifications extends Model
{
    use HasFactory;


    protected $table = 'notifications';

    public static function CreateNotification (string $uid,string $title,string $body,bool $read =false): ?Notifications
    {
        $notification = new Notifications();
        $notification->uid      = $uid;
        $notification->title    = $title;
        $notification->body     = $body;
        $notification->read     = $read;

        if($notification->save())
        {
            return $notification;
        }
        return null;
    }
}
