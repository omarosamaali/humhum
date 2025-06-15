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
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 10px;
        }

        .details-item {
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .details-item strong {
            display: block;
            margin-bottom: 5px;
            color: rgba(0, 0, 0, 0.8);
            font-weight: bold;
        }

        .details-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
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
                <div class="details-item">
                    <strong>الشيف:</strong> {{ $recipe->chef ? $recipe->chef->name : 'غير محدد' }}
                </div>
                <div class="details-item">
                    <strong>نوع المطبخ:</strong> {{ $recipe->kitchens ? $recipe->kitchens->name_ar : 'غير محدد' }}
                </div>
                <div class="details-item">
                    <strong>التصنيف الرئيسي:</strong> {{ $recipe->mainCategory ? $recipe->mainCategory->name : 'غير محدد' }}
                </div>
                <div class="details-item">
                    <strong>التصنيفات الفرعية:</strong>
                    <div class="tags-container d-inline-block">
                        @forelse ($recipe->subCategories as $subCategory)
                            <span class="badge">{{ $subCategory->name }}</span>
                        @empty
                            لا توجد
                        @endforelse
                    </div>
                </div>
                <div class="details-item">
                    <strong>عدد الوجبات:</strong> {{ $recipe->servings }}
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
                    @if ($recipe->recipeSteps && $recipe->recipeSteps->count() > 0)
                        @foreach ($recipe->recipeSteps as $index => $step)
                            <li>
                                <i class="fas fa-arrow-right"></i>
                                {{ $step->step_text ?? 'بدون وصف' }}

                                @if ($step->media && is_array($step->media))
                                    <div class="step-media mt-2">
                                        @foreach ($step->media as $mediaItem)
                                            @php
                                                $mediaPath = isset($mediaItem['path'])
                                                    ? Storage::url($mediaItem['path'])
                                                    : '';
                                                $mediaType = $mediaItem['type'] ?? 'unknown';
                                            @endphp

                                            @if (!empty($mediaPath))
                                                @if ($mediaType === 'image')
                                                    <img src="{{ $mediaPath }}" alt="Step Media"
                                                        class="media-preview img-fluid"
                                                        style="max-width: 200px; margin: 5px;">
                                                @elseif ($mediaType === 'video')
                                                    <video src="{{ $mediaPath }}" controls class="media-preview video"
                                                        style="max-width: 200px; margin: 5px;"></video>
                                                @endif
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
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('admin.recipes.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة لقائمة الوصفات
            </a>
        </div>
    </div>
@endsection