@component('mail::message')
# رمز التحقق الخاص بك

رمز التحقق (OTP) الخاص بك هو: **{{ $otp }}**

هذا الرمز صالح لمدة {{ config('auth.passwords.users.expire') ?? 5 }} دقائق.

إذا لم تطلب هذا، فتجاهل هذا البريد الإلكتروني.

شكرا لك،
{{ config('app.name') }}
@endcomponent