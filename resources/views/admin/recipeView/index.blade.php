@extends('layouts.admin')

@section('title', 'عرض الوصفات')
@section('page-title', 'عرض الوصفات')

@push('styles')
    <style>
        /* .add-section { ... } -- هذا الجزء يمكن إزالته إذا لم تعد هناك دالة إضافة */
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

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            background-color: white;
            /* إضافة خلفية للجدول */
        }

        .action-buttons .btn {
            padding: 5px 10px;
            font-size: 12px;
            margin: 0 2px;
        }

        .flag-img {
            width: 55px;
            height: auto;
            border-radius: 3px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        }

        .table th,
        .table td {
            vertical-align: middle;
            /* محاذاة عمودية للمحتوى في الجدول */
        }
    </style>
@endpush

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-striped"> {{-- أضفت table-striped لجمالية الجدول --}}
            <thead class="bg-primary text-white"> {{-- خلفية لرأس الجدول --}}
                <tr>
                    <th>#</th>
                    <th>اللغة</th>
                    <th>الوصفة</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recipes as $language)
                    {{-- لا حاجة لـ $languages ?? [] --}}
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="flex gap-1">
                                
                               @if ($language->dish_image)
                                <img src="{{ Storage::url($language->dish_image) }}" alt="{{ $language->title }}"
                                    class="flag-img ">
                            @else
                                <img src="{{ asset('assets/default-recipe-image.png') }}" alt="بدون صورة"
                                    class="flag-img ">
                            @endif
                                {{ $language->name }}
                            </div>
                        </td>
                        <td>
                            <div class="flex gap-1">
                                <div class="flex gap-1">
                                    @if ($language->dish_image)
                                <img src="{{ Storage::url($language->dish_image) }}" alt="{{ $language->title }}"
                                    class="flag-img">
                            @else
                                <img src="{{ asset('assets/default-recipe-image.png') }}" alt="بدون صورة"
                                    class="flag-img">
                            @endif
                                    53135
                                </div>
                                - كشري
                            </div>


                        </td>

                        <td>
                            <span class="badge {{ $language->status_badge_class }}">
                                {{ $language->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                {{-- زر العرض (Show) --}}
                                {{-- <a href="{{ route('admin.languages.show', $language->code) }}" class="btn btn-info btn-sm"
                                    title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a> --}}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4"> {{-- تم تعديل colspan --}}
                            <i class="fas fa-language text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">لا توجد بيانات لغات</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- لا يوجد Pagination لأننا نعرض جميع اللغات الثابتة --}}
    {{-- @if (isset($languages) && $languages->hasPages())
        <div class="flex justify-center mt-4">
            {{ $languages->links('vendor.pagination.tailwind') }}
        </div>
    @endif --}}

    {{-- لا يوجد Modal للحذف هنا أيضاً --}}
@endsection

@push('scripts')
    {{-- لم تعد هناك حاجة لـ confirmDelete لأن لا يوجد زر حذف --}}
    {{-- <script>
        function confirmDelete(languageId) {
            // ...
        }
    </script> --}}

    {{-- لا توجد حاجة لـ JavaScript هنا لأن لا يوجد form إضافة/تعديل بنفس الصفحة --}}
@endpush
