@extends('layouts.admin')

@section('title', 'تفاصيل الوصفة: ' . $recipe->title)
@section('page-title', 'تفاصيل الوصفة')

@push('styles')
    <style>
        .details-card {
            background: white;
            color: black;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .details-card h4 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 10px;
        }

        .details-item {
            margin-bottom: 15px;
            font-size: 1.1rem;
            display: flex;
            /* justify-content: space-between; */
            flex-direction: row;
        }

        .details-item strong {
            margin-bottom: 5px;
            color: rgba(0, 0, 0, 0.8);
            font-weight: bold;
        }

        .details-image {
            width: 100%;
            height: 36%;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .status-badge {
            padding: 0.6em 1em;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .status-active {
            background-color: #28a745;
            color: white;
        }

        .status-inactive {
            background-color: #dc3545;
            color: white;
        }

        .status-free {
            background-color: #17a2b8;
            color: white;
        }

        .status-paid {
            background-color: #ffc107;
            color: #333;
        }

        .btn-back {
            background-color: white;
            color: #764ba2;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: #eee;
            color: #667eea;
        }

        .section-title {
            font-size: 1.3rem;
            margin-top: 25px;
            margin-bottom: 10px;
            color: rgba(0, 0, 0, 0.9);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            padding-bottom: 5px;
        }

        .content-list {
            list-style: none;
            padding-left: 0;
        }

        .content-list li {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 8px 15px;
            border-radius: 5px;
            margin-bottom: 8px;
            display: flex;
            align-items: flex-start;
        }

        .content-list li i {
            margin-right: 10px;
            color: #a7d9ff;
            font-size: 1.2rem;
            margin-top: 3px;
        }

        .tags-container .badge {
            background-color: rgba(255, 255, 255, 0.2);
            color: black;
            margin-right: 5px;
            margin-bottom: 5px;
            padding: 0.6em 1em;
            border-radius: 5px;
            font-weight: normal;
        }

        .media-preview {
            max-width: 150px;
            max-height: 100px;
            object-fit: contain;
            border-radius: 5px;
            margin-left: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .media-preview.video {
            max-height: 120px;
        }
    </style>
@endpush

@section('content')
    <div class="details-card">
        <h4 class="text-center">{{ $recipe->title }}</h4>

        <div class="row">
            <div class="col-md-5 text-center">
                @if ($recipe->dish_image)
                    <img src="{{ Storage::url($recipe->dish_image) }}" alt="{{ $recipe->title }}" class="details-image">
                @else
                    <img src="{{ asset('assets/default-recipe-image.png') }}" alt="بدون صورة" class="details-image">
                @endif
            </div>
            <div class="col-md-7">
                <div class="flex">
<div class="details-item ml-2">
    <strong>صورة الطاهي:</strong>
    @if ($recipe->chef && $recipe->chef->chefProfile && $recipe->chef->chefProfile->official_image)
        <img src="{{ Storage::url($recipe->chef->chefProfile->official_image) }}" alt="Official Image"
            class="h-[200px] rounded-lg w-[200px] mx-2 image-preview">
    @else
        <div class="detail-value">لا يوجد صورة</div>
    @endif
</div>

<div class="details-item">
                        <strong>الطاهي:</strong> {{ $recipe->chef ? $recipe->chef->name : 'غير محدد' }}
                    </div>
                </div>

                <div class="details-item">
                    <strong>اسم المدخل:</strong> {{ Auth::user()->name }}
                </div>

                <div class="details-item">
                    <strong>نوع المطبخ:</strong>
                    <div class="" name="kitchen_type_id" id="kitchen_type_id" required>
                        @foreach ($kitchens as $kitchen)
                            <div value="{{ $kitchen->id }}"
                                {{ old('kitchen_type_id', $recipe->kitchen_type_id) == $kitchen->id ? 'selected' : '' }}>
                                {{ $kitchen->name_ar ?? $kitchen->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="details-item">
                    <strong>التصنيف الرئيسي:</strong> {{ $recipe->mainCategories?->name_ar ?? 'غير محدد' }}
                </div>
                <div class="details-item">
                    <strong>التصنيفات الفرعية:</strong>
                    <div class="tags-container bg-green-500 rounded d-inline-block">
                        @forelse ($recipe->subCategories as $subCategory)
                            <span class="badge">{{ $subCategory->name_ar }}</span>
                        @empty
                            <span class="text-muted">لا توجد</span>
                        @endforelse
                    </div>
                </div>
                <div class="details-item">
                    <strong>تكفي ل:</strong> {{ $recipe->servings }} أشخاص
                </div>
                <div class="details-item">
                    <strong>وقت التحضير:</strong> {{ $recipe->preparation_time }} دقيقة
                </div>
                <div class="details-item">
                    <strong>السعرات الحرارية:</strong> {{ $recipe->calories ?? 'غير محدد' }}
                </div>
                <div class="details-item">
                    <strong>الدهون:</strong> {{ $recipe->fats ?? 'غير محدد' }} جرام
                </div>
                <div class="details-item">
                    <strong>الكربوهيدرات:</strong> {{ $recipe->carbs ?? 'غير محدد' }} جرام
                </div>
                <div class="details-item">
                    <strong>البروتين:</strong> {{ $recipe->protein ?? 'غير محدد' }} جرام
                </div>
                <div class="details-item">
                    <strong>نوع الوصفة:</strong>
                    <span class="status-badge {{ $recipe->is_free ? 'status-free' : 'status-paid' }}">
                        {{ $recipe->is_free ? 'مجانية' : 'مدفوعة' }}
                    </span>
                </div>
                <div class="details-item">
                    <strong>الحالة:</strong>
                    <span class="status-badge {{ $recipe->status ? 'status-active' : 'status-inactive' }}">
                        {{ $recipe->status ? 'فعال' : 'غير فعال' }}
                    </span>
                </div>
                <div class="details-item">
                    <strong>تاريخ الإنشاء:</strong> {{ $recipe->created_at->format('d/m/Y H:i') }}
                </div>
                <div class="details-item">
                    <strong>آخر تحديث:</strong> {{ $recipe->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h5 class="section-title">المكونات:</h5>
                <ul class="content-list">
                    @foreach (explode("\n", $recipe->ingredients) as $ingredient)
                        @if (trim($ingredient) !== '')
                            <li><i class="fas fa-check-circle"></i> {{ trim($ingredient) }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>


            <div class="col-md-6">
                <h5 class="section-title">خطوات التحضير:</h5>
                <ol class="content-list">
                    @if ($recipe->steps && is_array($recipe->steps) && count($recipe->steps) > 0)
                        @foreach ($recipe->steps as $index => $step)
                            <li>
                                <i class="fas fa-arrow-right"></i>
                                {{ $step['description'] ?? 'بدون وصف' }}

                                @if (isset($step['media']) && is_array($step['media']) && !empty($step['media']))
                                    <div class="step-media mt-2">
                                        @foreach ($step['media'] as $mediaItem)
                                            @php
                                                // *** التعديل الرئيسي هنا ***
                                                // تأكد من أننا نستخدم مفتاح 'url' لأنه هو الذي يجب أن يحتوي على المسار الكامل.
                                                // إذا لم يكن موجوداً، أو كان فارغاً، فسيعتبر المسار غير صالح.
                                                $mediaSource = $mediaItem['url'] ?? null;
                                                $mediaType = $mediaItem['type'] ?? 'unknown';
                                                $mediaName = $mediaItem['original_name'] ?? 'Media_' . $index;
                                            @endphp

                                            {{-- استخدم Storage::disk('public')->exists للتحقق من وجود الملف فعليًا --}}
                                            @if ($mediaSource && Storage::disk('public')->exists($mediaSource))
                                                @if (Str::startsWith($mediaType, 'image'))
                                                    <img src="{{ Storage::url($mediaSource) }}" alt="{{ $mediaName }}"
                                                        class="media-preview img-fluid">
                                                @elseif (Str::startsWith($mediaType, 'video'))
                                                    <video controls class="media-preview video">
                                                        <source src="{{ Storage::url($mediaSource) }}"
                                                            type="{{ $mediaType }}">
                                                        متصفحك لا يدعم تشغيل الفيديو.
                                                    </video>
                                                @else
                                                    <span class="text-warning">نوع ميديا غير مدعوم:
                                                        {{ $mediaType }}</span>
                                                @endif
                                            @else
                                                {{-- رسالة توضيحية لما الملف بيكون مش موجود --}}
                                                <span class="text-danger">
                                                    الملف غير موجود أو المسار غير صالح:
                                                    {{ $mediaSource ?: 'مسار غير محدد' }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li class="text-warning">لا توجد خطوات متاحة</li>
                    @endif
                </ol>
            </div>
            {{-- ... (بقية الكود الخاص بالـ HTML والـ CSS سليم) ... --}}



        </div>

        <div class="text-center mt-4">
            <a href="{{ route('admin.recipes.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة لقائمة الوصفات
            </a>
        </div>
    </div>
@endsection
