<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChefProfile; // قد تحتاجها إذا كان هناك ربط مباشر
use App\Models\DeliveryLocation; // استيراد موديل أماكن التوصيل
use App\Models\User; // تأكد من استيراد موديل المستخدم
use App\Mail\ContractOtpMail; // استيراد الـ Mail Class
use Illuminate\Support\Facades\Mail; // استيراد الـ Mail Facade
use Illuminate\Support\Facades\Hash; // لاستخدام التشفير
use Illuminate\Support\Str; // لإنشاء سلاسل عشوائية
use Carbon\Carbon; // للتعامل مع الوقت
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
class ChefMarketController extends Controller
{
    public function edit()
    {
        // Ensure the user is authenticated and is a 'طاه' (chef)
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
        }

        $user = Auth::user();
        $chefProfile = $user->chefProfile; // Assuming a 'chefProfile' relationship exists on the User model

        // If a chef profile doesn't exist, you might want to create a new one
        // or handle this scenario appropriately. For now, we'll ensure it's passed.
        if (!$chefProfile) {
            $chefProfile = new ChefProfile(['user_id' => $user->id]);
            // You might not want to save it here, just create an empty instance for the view
            // $chefProfile->save();
        }

        return view('c1he3f.profile.edit-profile', compact('user', 'chefProfile'));
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول أولاً.');
        }

        $user = Auth::user();

        // قواعد التحقق (Validation rules)
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
                 // البريد الإلكتروني يجب أن يكون فريدًا باستثناء المستخدم الحالي
            ],
            'country' => 'nullable|string|max:255', // حقل الدولة في ChefProfile
            'imageUpload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // للصور: (اختياري، صور، الأنواع، الحجم الأقصى 2MB)
        ];

        // قم بالتحقق من الطلب
        $request->validate($rules);

        // تحديث بيانات المستخدم (User model)
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        // تحديث بيانات الشيف (ChefProfile model)
        // تأكد أن العلاقة (relationship) بين User و ChefProfile موجودة
        // وأن حقل 'country' موجود في جدول ChefProfile
        if ($user->role === 'طاه') {
            $chefProfile = $user->chefProfile; // افترض أن العلاقة اسمها chefProfile
            if (!$chefProfile) {
                // إذا لم يكن هناك ChefProfile موجود، قم بإنشاء واحد
                $chefProfile = new ChefProfile(['user_id' => $user->id]);
            }
            $chefProfile->country = $request->input('country');

            // معالجة رفع الصورة
            if ($request->hasFile('imageUpload')) {
                // حذف الصورة القديمة إذا وجدت
                if ($chefProfile->official_image) {
                    Storage::disk('public')->delete($chefProfile->official_image);
                }
                // حفظ الصورة الجديدة
                $path = $request->file('imageUpload')->store('chef_images', 'public');
                $chefProfile->official_image = $path;
            }
            $chefProfile->save();
        }

        return redirect()->route('c1he3f.profile.profile')->with('success', 'تم تحديث الملف الشخصي بنجاح!');
    }

    public function showTermsAndConditions()
    {
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
        }
        // تأكد من أن هذا الـ view موجود: resources/views/c1he3f/profile/agrem.blade.php
        return view('c1he3f.profile.agrem');
    }

    /**
     * عرض صفحة إدخال رمز التحقق (OTP) وإرسال الرمز عبر البريد الإلكتروني.
     * يتم استدعاؤها عند النقر على "التوقيع الإلكتروني على الاتفاقية".
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showSignAgreementForm()
    {
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
        }

        $user = Auth::user();

        // 1. إنشاء رمز OTP (مثلاً 4 أرقام)
        $otpCode = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        // 2. حفظ الـ OTP ووقت انتهاء الصلاحية في قاعدة البيانات للمستخدم
        // يجب أن يكون لديك حقلين في جدول المستخدم (أو جدول منفصل): `otp_code` و `otp_expires_at`
        $user->otp_code = Hash::make($otpCode); // تشفير الـ OTP لزيادة الأمان
        $user->otp_expires_at = Carbon::now()->addMinutes(5); // صلاحية لمدة 5 دقائق
        $user->save();

        // 3. إرسال البريد الإلكتروني
        try {
            Mail::to($user->email)->send(new ContractOtpMail($otpCode));
            return view('c1he3f.profile.sign')->with('success', 'تم إرسال رمز التحقق إلى بريدك الإلكتروني.');
        } catch (\Exception $e) {
            // سجل الخطأ للمراجعة
            \Log::error('Failed to send OTP email: ' . $e->getMessage(), ['email' => $user->email, 'user_id' => $user->id]);
            return redirect()->back()->with('error', 'حدث خطأ أثناء إرسال رمز التحقق. يرجى المحاولة مرة أخرى لاحقًا.');
        }
    }

    /**
     * معالجة طلب التحقق من رمز OTP وإتمام توقيع العقد.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyContractOtp(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
        }

        $request->validate([
            'digit-2' => 'required|numeric|digits:1',
            'digit-3' => 'required|numeric|digits:1',
            'digit-4' => 'required|numeric|digits:1',
            'digit-5' => 'required|numeric|digits:1',
        ], [
            'required' => 'هذا الحقل مطلوب.',
            'numeric' => 'هذا الحقل يجب أن يكون رقمًا.',
            'digits' => 'هذا الحقل يجب أن يكون رقمًا واحدًا.',
        ]);

        $user = Auth::user();
        $enteredOtp = $request->input('digit-2') . $request->input('digit-3') . $request->input('digit-4') . $request->input('digit-5');

        // التحقق من صلاحية الـ OTP
        if (!$user->otp_code || Carbon::now()->isAfter($user->otp_expires_at)) {
            return redirect()->back()->with('error', 'رمز التحقق غير صالح أو انتهت صلاحيته. يرجى إعادة الإرسال.');
        }

        // التحقق من تطابق الـ OTP المشفر
        if (!Hash::check($enteredOtp, $user->otp_code)) {
            return redirect()->back()->with('error', 'رمز التحقق غير صحيح. يرجى المحاولة مرة أخرى.');
        }

        // إذا كان الـ OTP صحيحًا وصالحًا:
        // 1. تحديث حالة الاتفاقية للمستخدم
        $user->contract_signed_at = Carbon::now();
        $user->otp_code = null; // مسح الـ OTP بعد الاستخدام
        $user->otp_expires_at = null; // مسح وقت انتهاء الصلاحية
        // يمكنك إضافة حقل آخر مثل `is_contract_signed` أو `agreement_status`
        // $user->is_contract_signed = true; // مثال
        $user->save();

        return redirect()->route('c1he3f.profile.profile')->with('success', 'تم توقيع الاتفاقية بنجاح!');
    }

    /**
     * معالجة طلب إعادة إرسال رمز OTP.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendContractOtp(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
        }

        $user = Auth::user();

        // 1. إنشاء رمز OTP جديد
        $otpCode = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        // 2. تحديث الـ OTP ووقت انتهاء الصلاحية في قاعدة البيانات
        $user->otp_code = Hash::make($otpCode); // تشفير الـ OTP
        $user->otp_expires_at = Carbon::now()->addMinutes(5); // صلاحية لمدة 5 دقائق
        $user->save();

        // 3. إرسال البريد الإلكتروني الجديد
        try {
            Mail::to($user->email)->send(new ContractOtpMail($otpCode));
            return redirect()->back()->with('success', 'تم إعادة إرسال رمز التحقق إلى بريدك الإلكتروني.');
        } catch (\Exception $e) {
            \Log::error('Failed to resend OTP email: ' . $e->getMessage(), ['email' => $user->email, 'user_id' => $user->id]);
            return redirect()->back()->with('error', 'حدث خطأ أثناء إعادة إرسال رمز التحقق. يرجى المحاولة مرة أخرى لاحقًا.');
        }
    }


    public function showMyMarket()
    {
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
        }

        // تعيين قيمة افتراضية للمتغير
        $chefHasMarket = false;

        // محاولة العثور على موقع التوصيل للشيف
        $deliveryLocation = Auth::user()->deliveryLocations()->first();

        // إذا وُجد موقع توصيل، استخدم قيمة has_market منه
        if ($deliveryLocation && isset($deliveryLocation->has_market)) {
            $chefHasMarket = (bool) $deliveryLocation->has_market;
        }

        return view('c1he3f.profile.my-market', compact('chefHasMarket'));
    }

    public function saveMyMarketChoice(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
        }

        $request->validate([
            'has_market' => 'required|boolean', // 0 لـ "لا", 1 لـ "نعم"
        ]);

        $user = Auth::user();

        // تحديث أو إنشاء سجل DeliveryLocation مع خيار has_market
        $deliveryLocation = $user->deliveryLocations()->first();

        if (!$deliveryLocation) {
            // إذا لم يكن هناك سجل لأماكن التوصيل بعد، قم بإنشاء واحد مبدئي
            $deliveryLocation = new DeliveryLocation([
                'user_id' => $user->id,
                'country' => 'غير محدد',
                'city' => 'غير محدد',
                'area' => 'غير محدد',
                'delivery_fee' => 0.00,
                'has_market' => $request->input('has_market')
            ]);
            $deliveryLocation->save();
        } else {
            $deliveryLocation->has_market = $request->input('has_market');
            $deliveryLocation->save();
        }

        if ($request->input('has_market')) {
            // إذا اختار "نعم"، يتم توجيهه لصفحة أماكن التوصيل
            return redirect()->route('c1he3f.profile.delivery-location')->with('success', 'تم حفظ اختيارك. يرجى إضافة أماكن التوصيل الآن.');
        } else {
            // إذا اختار "لا"، يتم توجيهه لصفحة البروفايل العادية
            return redirect()->route('c1he3f.profile.profile')->with('success', 'تم حفظ اختيارك.');
        }
    }

    public function showDeliveryLocations()
    {
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
        }

        $user = Auth::user();

        // Debug: Check if user exists
        if (!$user) {
            // dd('User not found');
        }

        // Debug: Check if deliveryLocations method exists
        if (!method_exists($user, 'deliveryLocations')) {
            // dd('deliveryLocations method does not exist on User model');
        }

        // Debug: Try to get the relationship
        try {
            $relationship = $user->deliveryLocations();
            // dd('Relationship object:', $relationship);
        } catch (\Exception $e) {
            // dd('Error getting relationship:', $e->getMessage());
        }

        // If we get here, try to get the actual data
        try {
            $deliveryLocations = $user->deliveryLocations()->get();
            // dd('Delivery locations:', $deliveryLocations);
        } catch (\Exception $e) {
            // dd('Error getting delivery locations:', $e->getMessage());
        }

        // This should not be reached in debug mode
        return view('c1he3f.profile.delivery-location', compact('deliveryLocations'));
    }
    public function showDeliveryLocationsAlternative()
    {
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
        }

        $user = Auth::user();

        // Ensure we always return a collection, even if empty
        $deliveryLocations = $user->deliveryLocations()->get();

        // Filter out placeholder records if needed
        $deliveryLocations = $deliveryLocations->filter(function ($location) {
            return $location->country !== 'غير محدد' || $location->has_market === true;
        });

        return view('c1he3f.profile.delivery-location', compact('deliveryLocations'));
    }

    public function showAddDeliveryAddressForm()
    {
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
        }
        return view('c1he3f.profile.add-delivery-address');
    }

    public function storeDeliveryAddress(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
        }

        $request->validate([
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'delivery_fee' => 'required|numeric|min:0',
        ], [
            'country.required' => 'حقل الدولة مطلوب.',
            'city.required' => 'حقل المدينة مطلوب.',
            'area.required' => 'حقل المنطقة مطلوب.',
            'delivery_fee.required' => 'حقل سعر رسوم التوصيل مطلوب.',
            'delivery_fee.numeric' => 'سعر رسوم التوصيل يجب أن يكون رقمًا.',
            'delivery_fee.min' => 'سعر رسوم التوصيل يجب أن يكون أكبر من أو يساوي 0.',
        ]);

        $user = Auth::user();

        // التحقق من وجود السجل الأساسي للـ has_market وتحديثه إذا لزم الأمر
        $existingRecord = $user->deliveryLocations()->where('country', 'غير محدد')->first();
        if ($existingRecord) {
            $existingRecord->has_market = true;
            $existingRecord->save();
        }

        DeliveryLocation::create([
            'user_id' => $user->id,
            'country' => $request->country,
            'city' => $request->city,
            'area' => $request->area,
            'delivery_fee' => $request->delivery_fee,
            'has_market' => true, // بما أنهم يضيفون موقعًا، فبالتأكيد لديهم سوق
        ]);

        return redirect()->route('c1he3f.profile.delivery-location')->with('success', 'تم إضافة مكان التوصيل بنجاح!');
    }

    public function destroyDeliveryLocation(DeliveryLocation $deliveryLocation)
    {
        if (!Auth::check() || Auth::user()->id !== $deliveryLocation->user_id) {
            return redirect()->back()->with('error', 'غير مصرح لك بحذف هذا الموقع.');
        }

        // إذا كان هذا السجل الوحيد للشيف، قم بتحديث has_market إلى false
        $user = Auth::user();
        $remainingLocations = $user->deliveryLocations()
            ->where('id', '!=', $deliveryLocation->id)
            ->where('country', '!=', 'غير محدد')
            ->count();

        $deliveryLocation->delete();

        // إذا لم تعد هناك مواقع توصيل حقيقية، تحديث السجل الأساسي
        if ($remainingLocations == 0) {
            $baseRecord = $user->deliveryLocations()->where('country', 'غير محدد')->first();
            if ($baseRecord) {
                $baseRecord->has_market = false;
                $baseRecord->save();
            }
        }

        return redirect()->route('c1he3f.profile.delivery-location')->with('success', 'تم حذف مكان التوصيل بنجاح!');
    }
}
