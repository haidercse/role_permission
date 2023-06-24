<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    use HasFactory;

    public static function getLatestNotifications($limit = 10)
    {
        $id = Auth::id();
        return static::where('user_id', $id)
        ->latest()
        ->take($limit)
        ->get();
    }

    public static function getUnSeenNotifications()
    {
        $id = Auth::id();
        return static::where('user_id',$id)
            ->where('is_seen', 0)
            ->get();
    }
}
