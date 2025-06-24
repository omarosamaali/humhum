<?php

namespace App\Http\Controllers\C1he3f\Auth; // لاحظ المسار الجديد C1he3f

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View; // استيراد View بدلاً من Inertia\Response

class ChefPasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view for Chefs.
     */
    public function create(): View
    {
        return view('c1he3f.auth.forgot-password', [ // Laravel interprets 'c1he3f.auth.forgot-password'
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request for Chefs.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // هذا الجزء يبقى كما هو، حيث يستخدم Facade Password لإرسال الرابط
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
