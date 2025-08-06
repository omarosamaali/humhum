@extends('layouts.admin')

@section('title', 'تعديل المستخدم')
@section('page-title', 'تعديل المستخدم')

@push('styles')
<style>
    .user-details-section {
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .detail-item {
        margin-bottom: 20px;
    }

    .detail-label {
        font-weight: 600;
        color: #555;
        font-size: 1.1rem;
        margin-bottom: 5px;
        display: block;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px 15px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .detail-value,
    .form-control {
        font-size: 1.05rem;
        color: #333;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        padding: 10px 15px;
        border-radius: 8px;
        word-wrap: break-word;
    }

    .detail-value.badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: .5em .75em;
        font-size: 0.9em;
        font-weight: bold;
    }

    .image-preview {
        max-width: 300px;
        border-radius: 8px;
        margin-top: 10px;
    }

    .chef-fields {
        display: none;
    }

</style>
@endpush


@section('content')
<div class="user-details-section">
    <div class="d-flex align-items-center mb-4">
        <i class="fas fa-edit ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        <h4 class="mb-0">تعديل مستخدم: {{ $user->name }}</h4>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الاسم:</span>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">البريد الإلكتروني:</span>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">كلمة السر (اتركها فارغة إذا لم تكن تريد التغيير):</span>
                    <input type="password" class="form-control" name="password">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الصلاحية:</span>
                    <select class="form-select" name="role" id="role" required>
                        <option value="مدير" {{ old('role', $user->role) == 'مدير' ? 'selected' : '' }}>مدير</option>
                        <option value="مشرف" {{ old('role', $user->role) == 'مشرف' ? 'selected' : '' }}>مشرف</option>
                        <option value="مدخل بيانات" {{ old('role', $user->role) == 'مدخل بيانات' ? 'selected' : '' }}>
                            مدخل بيانات</option>
                        <option value="طاه" {{ old('role', $user->role) == 'طاه' ? 'selected' : '' }}>طاه</option>
                    </select>
                    @error('role')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الحالة:</span>
                    <select class="form-select" name="status" id="status" required>
                        <option value="فعال" {{ old('status', $user->status) == 'فعال' ? 'selected' : '' }}>فعال
                        </option>
                        <option value="غير فعال" {{ old('status', $user->status) == 'غير فعال' ? 'selected' : '' }}>غير
                            فعال</option>
                        <option value="بانتظار التفعيل" 
                        {{ old('status', $user->status) == 'بانتظار التفعيل' ? 'selected' : '' }}>بإنتظار
                            إستكمال البيانات</option>
                    </select>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row chef-fields" id="chef-fields" style="display: {{ old('role', $user->role) == 'طاه' ? 'block' : 'none' }}">
            {{-- Country Field --}}
            <div class="col-md-6">

                <div class="detail-item">
                    <span class="detail-label">الدولة:</span>
                    <select class="form-select" id="country" name="country" required style="width: 100%; text-align: center;">
                        <option value="">اختر الدولة</option>
                        <option value="sa" {{ old('country', $user->chefProfile->country ?? '') == 'sa' ? 'selected' : '' }}>المملكة العربية السعودية</option>
                        <option value="ae" {{ old('country', $user->chefProfile->country ?? '') == 'ae' ? 'selected' : '' }}>الإمارات العربية المتحدة</option>
                        <option value="qa" {{ old('country', $user->chefProfile->country ?? '') == 'qa' ? 'selected' : '' }}>قطر</option>
                        <option value="kw" {{ old('country', $user->chefProfile->country ?? '') == 'kw' ? 'selected' : '' }}>الكويت</option>
                        <option value="bh" {{ old('country', $user->chefProfile->country ?? '') == 'bh' ? 'selected' : '' }}>البحرين</option>
                        <option value="om" {{ old('country', $user->chefProfile->country ?? '') == 'om' ? 'selected' : '' }}>سلطنة عُمان</option>
                        <option value="ye" {{ old('country', $user->chefProfile->country ?? '') == 'ye' ? 'selected' : '' }}>اليمن</option>
                        <option value="iq" {{ old('country', $user->chefProfile->country ?? '') == 'iq' ? 'selected' : '' }}>العراق</option>
                        <option value="sy" {{ old('country', $user->chefProfile->country ?? '') == 'sy' ? 'selected' : '' }}>سوريا</option>
                        <option value="jo" {{ old('country', $user->chefProfile->country ?? '') == 'jo' ? 'selected' : '' }}>الأردن</option>
                        <option value="lb" {{ old('country', $user->chefProfile->country ?? '') == 'lb' ? 'selected' : '' }}>لبنان</option>
                        <option value="ps" {{ old('country', $user->chefProfile->country ?? '') == 'ps' ? 'selected' : '' }}>فلسطين</option>
                        <option value="eg" {{ old('country', $user->chefProfile->country ?? '') == 'eg' ? 'selected' : '' }}>مصر</option>
                        <option value="sd" {{ old('country', $user->chefProfile->country ?? '') == 'sd' ? 'selected' : '' }}>السودان</option>
                        <option value="ly" {{ old('country', $user->chefProfile->country ?? '') == 'ly' ? 'selected' : '' }}>ليبيا</option>
                        <option value="tn" {{ old('country', $user->chefProfile->country ?? '') == 'tn' ? 'selected' : '' }}>تونس</option>
                        <option value="dz" {{ old('country', $user->chefProfile->country ?? '') == 'dz' ? 'selected' : '' }}>الجزائر</option>
                        <option value="ma" {{ old('country', $user->chefProfile->country ?? '') == 'ma' ? 'selected' : '' }}>المغرب</option>
                        <option value="mr" {{ old('country', $user->chefProfile->country ?? '') == 'mr' ? 'selected' : '' }}>موريتانيا</option>
                        <option value="dj" {{ old('country', $user->chefProfile->country ?? '') == 'dj' ? 'selected' : '' }}>جيبوتي</option>
                        <option value="so" {{ old('country', $user->chefProfile->country ?? '') == 'so' ? 'selected' : '' }}>الصومال</option>
                        <option value="km" {{ old('country', $user->chefProfile->country ?? '') == 'km' ? 'selected' : '' }}>جزر القمر</option>
                    </select>


                    @error('country')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Bio Field --}}
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">نبذة تعريفية:</span>
                    <textarea class="form-control" name="bio" rows="4">{{ old('bio', $user->chefProfile->bio ?? '') }}</textarea>
                    @error('bio')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Contract Type Field --}}
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">نوع التعاقد:</span>
                    <select class="form-select" name="contract_type" id="contract_type_select">
                        <option value="per_recipe" {{ old('contract_type', $user->chefProfile->contract_type ?? '') == 'per_recipe' ? 'selected' : '' }}>
                            بالوصفة</option>
                        <option value="annual_subscription" {{ old('contract_type', $user->chefProfile->contract_type ?? '') == 'annual_subscription' ? 'selected' : '' }}>
                            بنظام الاشتراك</option>
                    </select>
                    @error('contract_type')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Subscription Fields (Hidden by default, shown with JS) --}}
            <div id="subscription-fields" class="col-md-12" style="display: {{ old('contract_type', $user->chefProfile->contract_type ?? '') == 'annual_subscription' ? 'block' : 'none' }}">
                <div class="">
                    الأسعار بالدرهم الإماراتي فقط
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">سعر اشتراك 3 شهور</label>
                            <input type="number" step="0.01" class="form-control" name="subscription_3_months_price" value="{{ old('subscription_3_months_price', $user->chefProfile->subscription_3_months_price ?? '') }}">
                            @error('subscription_3_months_price')
                            <div class="text-danger">{{ $message }}</div> {{-- تم تعديلها لـ text-danger --}}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">سعر اشتراك 6 شهور</label>
                            <input type="number" step="0.01" class="form-control" name="subscription_6_months_price" value="{{ old('subscription_6_months_price', $user->chefProfile->subscription_6_months_price ?? '') }}">
                            @error('subscription_6_months_price')
                            <div class="text-danger">{{ $message }}</div> {{-- تم تعديلها لـ text-danger --}}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">سعر اشتراك 12 شهر</label>
                            <input type="number" step="0.01" class="form-control" name="subscription_12_months_price" value="{{ old('subscription_12_months_price', $user->chefProfile->subscription_12_months_price ?? '') }}">
                            @error('subscription_12_months_price')
                            <div class="text-danger">{{ $message }}</div> {{-- تم تعديلها لـ text-danger --}}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Profit Transfer Details Field --}}
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">بيانات تحويل الأرباح:</span>
                    <textarea class="form-control" name="profit_transfer_details" rows="4">{{ old('profit_transfer_details', $user->chefProfile->profit_transfer_details ?? '') }}</textarea>
                    @error('profit_transfer_details')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Official Image Fields --}}
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الصورة الرسمية الحالية:</span>
                    @if ($user->chefProfile && $user->chefProfile->official_image)
                    <img src="{{ asset('storage/' . $user->chefProfile->official_image) }}" alt="Current Image" class="image-preview" style="max-width: 150px; height: auto; margin-top: 10px;">
                    @else
                    <div class="detail-value">لا يوجد صورة</div>
                    @endif
                </div>
                <div class="detail-item">
                    <span class="detail-label">تغيير الصورة الرسمية:</span>
                    <input type="file" class="form-control" name="official_image">
                    @error('official_image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div> {{-- End of chef-fields --}}

        <div class="btn-section mt-4">
            <a href="{{ route('admin.users.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة لقائمة المستخدمين
            </a>
            <button type="submit" class="edit-btn">
                <i class="fas fa-save ms-1"></i>
                حفظ التعديلات
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role');
        const chefFields = document.getElementById('chef-fields');
        const contractTypeSelect = document.getElementById(
            'contract_type_select'); // احصل على عنصر select لنوع التعاقد
        const subscriptionFields = document.getElementById('subscription-fields'); // احصل على div حقول الاشتراك

        // دالة لتبديل عرض حقول الطاهي
        function toggleChefFields() {
            if (roleSelect.value === 'طاه') {
                chefFields.style.display = 'block';
                toggleSubscriptionFields(); // استدعاء لتبديل حقول الاشتراك عند عرض حقول الطاهي
            } else {
                chefFields.style.display = 'none';
                subscriptionFields.style.display = 'none'; // إخفاء حقول الاشتراك إذا لم يكن الدور "طاه"
            }
        }

        // دالة لتبديل عرض حقول الاشتراك
        function toggleSubscriptionFields() {
            if (contractTypeSelect.value === 'annual_subscription') {
                subscriptionFields.style.display = 'block';
            } else {
                subscriptionFields.style.display = 'none';
            }
        }

        // استدعاء الدالة عند تحميل الصفحة للحالة الأولية
        toggleChefFields();

        // إضافة مستمع للأحداث عند تغيير الصلاحية
        roleSelect.addEventListener('change', toggleChefFields);

        // إضافة مستمع للأحداث عند تغيير نوع التعاقد
        contractTypeSelect.addEventListener('change', toggleSubscriptionFields);
    });

</script>
@endpush
