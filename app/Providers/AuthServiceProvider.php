<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User; // تأكد من استيراد نموذج المستخدم الخاص بك

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        // ...
        Gate::define('isChef', function (User $user) {
            return $user->role === 'طاه';
        });
        // Define an 'isAdmin' gate
        Gate::define('isAdmin', function (User $user) {
            // الطريقة 1: إذا كان لديك عمود is_admin (boolean) في جدول المستخدمين
            // return $user->is_admin;

            // الطريقة 2: إذا كان لديك عمود role (string) في جدول المستخدمين
            return $user->role === 'مدير'; 

            // الطريقة 3: إذا كان لديك علاقة أدوار مع جدول roles (أكثر تعقيدًا لكنه أكثر قوة)
            // return $user->roles()->where('name', 'admin')->exists();
        });
    }
}
