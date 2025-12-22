<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {

    $user = DB::table('users')
        ->where('email', $request->email)
        ->first();

    if (! $user || $request->password !== $user->password) {
        return response()->json([
            'success' => false,
            'message' => 'بيانات غير صحيحة'
        ], 401);
    }

    $user = (array) $user;

    unset(
        $user['name_ar'],
        $user['name_en'],
        $user['name_id'],
        $user['name_am'],
        $user['name_hi'],
        $user['name_bn'],
        $user['name_ml'],
        $user['name_fil'],
        $user['name_ur'],
        $user['name_ta'],
        $user['name_ps']
    );

    return response()->json([
        'success' => true,
        'message' => 'تم تسجيل الدخول بنجاح',
        'user' => $user
    ]);
});

Route::get('/notifications/{user_id}', function ($user_id) {

    $user = DB::table('users')
        ->select('id', 'role')
        ->where('id', $user_id)
        ->first();

    if (! $user) {
        return response()->json([
            'success' => false,
            'message' => 'المستخدم غير موجود'
        ], 404);
    }

    $notifications = DB::table('notifications')
        ->where('user_id', $user_id)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'success' => true,
        'role' => $user->role,               // 👈 نوع الحساب
        'notifications_count' => $notifications->count(),
        'notifications' => $notifications
    ]);
});
