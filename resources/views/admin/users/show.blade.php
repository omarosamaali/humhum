@extends('layouts.admin')

@section('title', 'تفاصيل المستخدم')
@section('page-title', 'تفاصيل المستخدم')

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

        .detail-value {
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
    </style>
@endpush

@section('content')
    <div class="user-details-section">
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-info-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            <h4 class="mb-0">تفاصيل المستخدم: {{ $user->name }}</h4>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الاسم:</span>
                    <div class="detail-value">{{ $user->name }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">البريد الإلكتروني:</span>
                    <div class="detail-value">{{ $user->email }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الصلاحية:</span>
                    <div style="color: white;" class="detail-value badge {{ $user->getRoleBadgeClass() }}">
                        {{ $user->role }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الحالة:</span>
                    <div class="detail-value">
                        <span class="badge {{ $user->getStatusBadgeClass() }}" style="color: black;"> {{ $user->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">تاريخ التسجيل:</span>
                    <div class="detail-value">{{ $user->created_at->format('Y-m-d H:i:s') }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">آخر تحديث:</span>
                    <div class="detail-value">{{ $user->updated_at->format('Y-m-d H:i:s') }}</div>
                </div>
            </div>
        </div>

        @if($user->role === 'طاه' && $user->chefProfile)
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">الدولة:</span>
                        <div class="detail-value">{{ $user->chefProfile->country }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">نبذة تعريفية:</span>
                        <div class="detail-value">{{ $user->chefProfile->bio }}</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">نوع التعاقد:</span>
                        <div class="detail-value">{{ $user->chefProfile->contract_type === 'per_recipe' ? 'بالوصفة' : 'بنظام الاشتراك' }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">بيانات تحويل الأرباح:</span>
                        <div class="detail-value">{{ $user->chefProfile->profit_transfer_details }}</div>
                    </div>
                </div>
            </div>

            {{-- إضافة حقول الاشتراك هنا --}}
            @if($user->chefProfile->contract_type === 'annual_subscription')
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5 class="mb-3"><i class="fas fa-money-bill-wave ms-2"></i> أسعار الاشتراكات</h5>
                    </div>
                    @if($user->chefProfile->subscription_3_months_price)
                        <div class="col-md-4">
                            <div class="detail-item">
                                <span class="detail-label">اشتراك 3 شهور:</span>
                                <div class="detail-value">{{ $user->chefProfile->subscription_3_months_price }}</div>
                            </div>
                        </div>
                    @endif
                    @if($user->chefProfile->subscription_6_months_price)
                        <div class="col-md-4">
                            <div class="detail-item">
                                <span class="detail-label">اشتراك 6 شهور:</span>
                                <div class="detail-value">{{ $user->chefProfile->subscription_6_months_price }}</div>
                            </div>
                        </div>
                    @endif
                    @if($user->chefProfile->subscription_12_months_price)
                        <div class="col-md-4">
                            <div class="detail-item">
                                <span class="detail-label">اشتراك 12 شهر:</span>
                                <div class="detail-value">{{ $user->chefProfile->subscription_12_months_price }}</div>
                            </div>
                        </div>
                    @endif
                    {{-- إذا لم يتم تحديد أي سعر اشتراك، يمكنك عرض رسالة --}}
                    @if(
                        !$user->chefProfile->subscription_3_months_price &&
                        !$user->chefProfile->subscription_6_months_price &&
                        !$user->chefProfile->subscription_12_months_price
                    )
                        <div class="col-md-12">
                            <div class="detail-item">
                                <div class="detail-value">لم يتم تحديد أسعار اشتراك لهذا الطاهي بعد.</div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            {{-- نهاية حقول الاشتراك --}}

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">الصورة الرسمية:</span>
                        @if($user->chefProfile->official_image)
                            <img src="{{ asset('storage/' . $user->chefProfile->official_image) }}" alt="Official Image" class="image-preview">
                        @else
                            <div class="detail-value">لا يوجد صورة</div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <div class="btn-section mt-4">
            <a href="{{ route('admin.users.index') }}" class="btn btn-light me-2">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة لقائمة المستخدمين
            </a>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                <i class="fas fa-edit ms-1"></i>
                تعديل المستخدم
            </a>
        </div>
    </div>
@endsection