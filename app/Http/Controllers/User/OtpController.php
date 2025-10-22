<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function showForm(Request $request)
    {
        $email = $request->email;
        return view('users.auth.verify-otp', compact('email'));
    }

    public function verify(Request $request)
    {
        $request->validate(['email' => 'required|email', 'code' => 'required|digits:4']);

        $otp = Otp::where('code', $request->code)
            ->whereHas('user', fn($q) => $q->where('email', $request->email))
            ->where('expires_at', '>', now())
            ->first();
            if ($otp) {
            Auth::login($otp->user, true);
            $otp->user->update(['email_verified_at' => now()]);
            $otp->delete();

            return redirect()->route('users.welcome')->with('success', 'تم التحقق بنجاح ✅');
        }

        return back()->withErrors(['code' => 'الرمز غير صحيح أو انتهت صلاحيته.']);
    }
}
