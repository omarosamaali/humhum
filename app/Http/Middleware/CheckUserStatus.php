<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // تأكد أن هذا السطر موجود
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        // Routes التي لا نريد تطبيق الـ middleware عليها
        $excludedRoutes = [
            'login',
            'register',
            'password.request',
            'password.reset',
            'verification.notice',
            'verification.verify',
            'verification.send',
        ];

        // تسجيل معلومات للـ debugging
        Log::info('CheckUserStatus middleware called', [
            'route' => $request->route() ? $request->route()->getName() : 'no-route',
            'user_authenticated' => Auth::check(),
            'url' => $request->url()
        ]);

        // تجاهل الـ middleware إذا كان الـ route مستثنى
        $currentRoute = $request->route() ? $request->route()->getName() : null;
        if (in_array($currentRoute, $excludedRoutes)) {
            Log::info('Route excluded from CheckUserStatus', ['route' => $currentRoute]);
            return $next($request);
        }

        if (Auth::check()) {
            $user = Auth::user();

            Log::info('User status check', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'user_status' => $user->status,
                'status_type' => gettype($user->status)
            ]);

            // التأكد من حالة الحساب (مفعل/غير مفعل)
            // 1 يعني غير فعال، 0 يعني فعال (أو أياً كان المنطق لديك)
            if ($user->status == 1) { // استخدم == لمرونة التحويل التلقائي للنوع
                Log::info('User account deactivated, logging out', ['user_id' => $user->id]);

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')->withErrors([
                    'email' => 'حسابك غير فعال حالياً. يرجى التواصل مع الإدارة.'
                ]);
            }

            // --- بداية منطق صلاحيات 'مدخل بيانات' ---
            // هنا بنفترض إن فيه عمود 'role' في جدول المستخدمين
            if ($user->role === 'مدخل بيانات') {
                // الصفحات المسموح بيها لـ 'مدخل بيانات'
                $allowedRoutes = [
                    'admin.dashboard', // لو عايز تسمح بالوصول للداشبورد
                    'admin.recipes.index',
                    'admin.recipes.create',
                    'admin.recipes.store',
                    'admin.recipes.show',
                    'admin.recipes.edit',
                    'admin.recipes.update',
                    'admin.recipes.destroy',
                    'admin.recipes.ajax-update',
                    'admin.recipeView.index',
                    'admin.recipeView.create',
                    'admin.recipeView.store',
                    'admin.recipeView.show',
                    'admin.recipeView.edit',
                    'admin.recipeView.update',
                    'admin.recipeView.destroy',
                    'profile.edit', // صفحات البروفايل مسموح بيها
                    'profile.update',
                    'profile.destroy',
                ];

                // تأكد إن الـ Route الحالي مسموح بيه
                if (!in_array($currentRoute, $allowedRoutes)) {
                    Log::warning('User tried to access forbidden route', [
                        'user_id' => $user->id,
                        'user_role' => $user->role,
                        'attempted_route' => $currentRoute
                    ]);
                    // لو مش مسموح بيه، اعمل redirect لصفحة معينة أو ارجع خطأ 403
                    return redirect()->route('admin.dashboard')->with('error', 'ليس لديك صلاحية للوصول لهذه الصفحة.');
                    // أو يمكنك استخدام:
                    // abort(403, 'غير مصرح لك بالوصول لهذه الصفحة.');
                }
            }
            // --- نهاية منطق صلاحيات 'مدخل بيانات' ---

        } else {
            // لو المستخدم مش عامل تسجيل دخول أساساً
            // ويمكنك هنا عمل إعادة توجيه لصفحة تسجيل الدخول إذا لم يكن الـ route مستثنى
            if (!in_array($currentRoute, $excludedRoutes)) {
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
