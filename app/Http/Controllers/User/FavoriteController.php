<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $user = auth()->user();
        $recipeId = $request->recipe_id;

        if (! $user) {
            return response()->json(['status' => 'error', 'message' => 'يجب تسجيل الدخول أولاً']);
        }

        // لو موجود بالفعل في المفضلة → نحذف
        if ($user->favorites()->where('recipe_id', $recipeId)->exists()) {
            $user->favorites()->detach($recipeId);
            return response()->json(['status' => 'removed', 'message' => 'تم إزالة الوجبة من المفضلة']);
        }
        // غير موجود → نضيف
        else {
            $user->favorites()->attach($recipeId);
            return response()->json(['status' => 'added', 'message' => 'تم إضافة الوجبة إلى المفضلة']);
        }
    }
}
