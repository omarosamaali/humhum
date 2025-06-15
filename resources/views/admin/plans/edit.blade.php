@extends('layouts.admin')

@section('title', 'تعديل الخطة')
@section('page-title', 'تعديل الخطة')

@push('styles')
    <style>
        /* استخدم نفس الستايلات التي كانت لديك لصفحة تعديل المستخدمين */
        .edit-form-section {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .back-btn,
        .update-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .back-btn {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: #5a6268;
            color: white;
        }

        .update-btn {
            background-color: #667eea;
            color: white;
            border: none;
        }

        .update-btn:hover {
            background-color: #5768d1;
        }

        .btn-section {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
    </style>
@endpush

@section('content')
    <div class="edit-form-section">
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-edit ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            <h4 class="mb-0">تعديل بيانات الخطة: {{ $plan->name_ar }}</h4>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">الباقة المرتبطة *</label>
                        <select class="form-select" name="package_id" required>
                            <option value="">اختر باقة</option>
                            @foreach ($packages as $package)
                                <option value="{{ $package->id }}"
                                    {{ old('package_id', $plan->package_id) == $package->id ? 'selected' : '' }}>
                                    {{ $package->name_ar }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">الاسم باللغة العربية *</label>
                        <input type="text" class="form-control" name="name_ar"
                            value="{{ old('name_ar', $plan->name_ar) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">السعر *</label>
                        <input type="number" step="0.01" class="form-control" name="price"
                            value="{{ old('price', $plan->price) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">المدة *</label>
                        <select class="form-select" name="duration_unit" required>
                            <option value="">اختر المدة</option>
                            <option value="1 شهر"
                                {{ old('duration_unit', $plan->duration_unit) == '1 شهر' ? 'selected' : '' }}>1 شهر</option>
                            <option value="3 شهور"
                                {{ old('duration_unit', $plan->duration_unit) == '3 شهور' ? 'selected' : '' }}>3 شهور
                            </option>
                            <option value="6 شهور"
                                {{ old('duration_unit', $plan->duration_unit) == '6 شهور' ? 'selected' : '' }}>6 شهور
                            </option>
                            <option value="12 شهر"
                                {{ old('duration_unit', $plan->duration_unit) == '12 شهر' ? 'selected' : '' }}>12 شهر
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">الحالة *</label>
                        <select class="form-select" name="status" required>
                            <option value="0" {{ old('status', $plan->status) == '0' ? 'selected' : '' }}>فعال
                            </option>
                            <option value="1" {{ old('status', $plan->status) == '1' ? 'selected' : '' }}>غير فعال
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">تاريخ الإنشاء</label>
                        <input type="text" class="form-control" value="{{ $plan->created_at->format('Y-m-d H:i') }}"
                            readonly>
                    </div>
                </div>
            </div>

            {{-- عرض حقول اللغات المترجمة للقراءة فقط أو للتعديل اليدوي إذا أردت --}}
            {{-- عرض حقول اللغات المترجمة للقراءة فقط (في Edit view يمكن جعلها للقراءة فقط أو للتعديل اليدوي) --}}
            {{-- في Show view، ستكون هذه الحقول للقراءة فقط بشكل طبيعي --}}

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">الاسم بالإنجليزية</label>
                        <input type="text" class="form-control" value="{{ $plan->name_en }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">الاسم بالإندونيسية</label>
                        <input type="text" class="form-control" value="{{ $plan->name_id }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">الاسم بالأمهرية</label>
                        <input type="text" class="form-control" value="{{ $plan->name_am }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">الاسم بالهندية</label>
                        <input type="text" class="form-control" value="{{ $plan->name_hi }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">الاسم بالبنغالية</label>
                        <input type="text" class="form-control" value="{{ $plan->name_bn }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">الاسم بالمالايالامية</label>
                        <input type="text" class="form-control" value="{{ $plan->name_ml }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">الاسم بالفلبينية</label>
                        <input type="text" class="form-control" value="{{ $plan->name_fil }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">الاسم بالأردية</label>
                        <input type="text" class="form-control" value="{{ $plan->name_ur }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">الاسم بالتاميلية</label>
                        <input type="text" class="form-control" value="{{ $plan->name_ta }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">الاسم بالنيبالية</label>
                        <input type="text" class="form-control" value="{{ $plan->name_ne }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">الاسم بالبشتو</label>
                        <input type="text" class="form-control" value="{{ $plan->name_ps }}" readonly>
                    </div>
                </div>
            </div>

            <div class="btn-section text-center">
                <a href="{{ route('admin.plans.index') }}" class="back-btn">
                    <i class="fas fa-arrow-right ms-1"></i>
                    العودة للقائمة
                </a>
                <button type="submit" class="update-btn">
                    <i class="fas fa-save ms-1"></i>
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
@endsection
