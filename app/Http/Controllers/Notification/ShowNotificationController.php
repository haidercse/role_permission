<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowNotificationController extends Controller
{
    public function index(){
        $authUserId = Auth::id();
        $notification = Notification::where('user_id',$authUserId)
                                    ->where('is_seen',0)
                                    ->get();

        return $notification->count();

    }

    public function store(Request $request){
        $authUserId = Auth::id();
        $notification = Notification::where('user_id',$authUserId)
                                    ->where('is_seen',0)
                                    ->update(['is_seen' => 1]);
    }
}
