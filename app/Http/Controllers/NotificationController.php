<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function poll(Request $request)
    {
        $user = $request->user();
        $role = $user->role;
        $items = Notification::where(function($q) use ($role, $user) {
                $q->where('target_role', $role)
                  ->orWhere('target_user_id', $user->id);
            })
            ->whereNull('read_at')
            ->orderBy('created_at','desc')
            ->limit(20)
            ->get();
        return response()->json($items);
    }
}