@extends('layouts.admin')

@section('content')
<style>
    #icon-eye:hover {
        background: black !important;
        color: white !important;
        border: 1px solid black !important;
    }
</style>
    <div class="recipe-number mb-3">
        <span class="badge bg-primary fs-6" style="background-color: #ad52da !important">رقم الوصفة: #{{ $recipe->recipe_code }} - 
            {{ $recipe->title }}</span>
    </div>

    <div class="recipe-details" style="margin-bottom: 1.5rem;">
        <div class="row">
            <div class="col-md-12 "
                style="display: flex; margin-left: auto; margin-right: auto; text-align: right; align-items: 
                center; justify-content: space-between;">
                @if ($recipe->user_id)
                    <div class="detail-item" style="display: inline-block; margin-left: 20px;">
                        <i class="fas fa-user" style="color: #000000; margin-left: 5px;"></i>
                        <strong>اسم مدخل الوصفة:</strong> {{ $recipe->user->name }}
                    </div>
                @endif
                <div>
                    <div class="detail-item" style="display: flex; align-items: center; gap: 10px; margin-left: 20px; width: 255px;">
                        <i class="fas fa-calendar" style="color: #000000; margin-left: 5px;"></i>
                        <strong>تاريخ النشر:</strong>
                        <div>
                            {{ $recipe->updated_at->format('Y-m-d') }}
                        </div>

                    </div>
                </div>
                <div>
                    <div class="detail-item" style="display: flex; align-items: center; gap: 10px; margin-left: 20px;">
                        <i class="fas fa-calendar" style="color: #000000; margin-left: 5px;"></i>
                        <strong>تاريخ التحديث:</strong>
                        <div>
                            {{ $recipe->created_at->format('Y-m-d') }}
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12" style="display: flex; margin-left: auto; margin-right: auto; text-align: right; align-items: 
                center; justify-content: space-between;">
                @if ($recipe->is_free)
                    <div class="detail-item" style="display: inline-block; margin-left: 20px;">
                            <i class="fa-solid fa-utensils" style="color: #000000; margin-left: 5px;"></i>
                        <strong>نوع الوصفة:</strong> {{ $recipe->is_free === 1 ? 'مجانية' : 'مدفوعة' }}
                    </div>
                @endif

                <div class="detail-item" style="display: inline-block; margin-left: 20px;">
                    <i class="fas fa-eye" style="color: #000000; margin-left: 5px;"></i>
                    <strong>حالة الوصفة:</strong> {{ $recipe->status === 1 ? 'فعال' : 'غير فعال' }}
                </div>

                <div class="detail-item" style="display: inline-block; margin-left: 20px; width: 224px;">
                    <i class="fas fa-users" style="color: #000000; margin-left: 5px;"></i>
                    <strong>عدد مرات الإستخدام:</strong> 35
                </div>

                {{-- @if ($recipe->calories)
                    <div class="detail-item" style="display: inline-block; margin-left: 20px;">
                        <i class="fas fa-fire" style="color: #ffc107; margin-left: 5px;"></i>
                        <strong>السعرات الحرارية:</strong> {{ $recipe->calories }} سعر
                    </div>
                @endif --}}

                {{-- @if ($recipe->fats)
                    <div class="detail-item" style="display: inline-block; margin-left: 20px;">
                        <i class="fas fa-tint" style="color: #17a2b8; margin-left: 5px;"></i>
                        <strong>الدهون:</strong> {{ $recipe->fats }} غرام
                    </div>
                @endif
 --}}
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div style="background: #660099; justify-content: center;" class="card-header text-white d-flex align-items-center">
            <h5 class="mb-0" style="text-align: center;"> الترجمة لكل لغة</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="background:black; width: 60px; text-align: center;;">#</th>
                            <th style="background:black; width: 200px; text-align: center;;">اللغة</th>
                            <th style="background:black; width: 200px; text-align: center;;">الطاه</th>
                            <th style="background:black; width: 200px; text-align: center;;">نوع المطبخ</th>
                            <th style="background:black; width: 200px; text-align: center;;">التصنيف الرئيسي</th>
                            <th style="background:black; width: 200px; text-align: center;;">التصنيف الفرعي</th>
                            <th style="background:black; width: 200px; text-align: center;;">حالة اللغة</th>
                            <th class="text-center" style="background:black;  text-align: center;;">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allLanguages as $language)
                            @php
                                $status = $translationStatus[$language->code] ?? [
                                    'is_translated' => false,
                                    'status' => 'missing',
                                    'completeness' => 0,
                                ];
                                // إصلاح عرض اسم المطبخ
                                $kitchenName = 'غير محدد';
                                if ($recipe->kitchen) {
                                    $kitchenFieldName = 'name_' . $language->code;
                                    $kitchenName =
                                        $recipe->kitchen->{$kitchenFieldName} ??
                                        ($recipe->kitchen->name_ar ?? 'غير مترجم');
                                }

                                // **التعديل لاسم الطاهي داخل حلقة اللغات**
                                $chefDisplayName = 'غير محدد';
                                if ($recipe->chef) {
                                    $chefFieldNameForTable = 'name_' . $language->code; // هنا نستخدم $language->code
                                    $chefDisplayName =
                                        $recipe->chef->{$chefFieldNameForTable} ??
                                        ($recipe->chef->name_ar ?? ($recipe->chef->name ?? 'غير مترجم'));
                                }
                                // نهاية التعديل لاسم الطاهي
                                $subCategoryNames = [];
                                if ($recipe->subCategories->count() > 0) {
                                    foreach ($recipe->subCategories as $subCategory) {
                                        $subCategoryFieldName = 'name_' . $language->code;
                                        $subCategoryNames[] =
                                            $subCategory->{$subCategoryFieldName} ??
                                            ($subCategory->name_ar ?? 'غير مترجم');
                                    }
                                }

                                // **** أضف هذا الكود هنا لتعريف mainCategoryName ****
                                $mainCategoryName = 'غير محدد';
                                if ($recipe->mainCategories) {
                                    // تأكد من استخدام mainCategories (اسم العلاقة في الموديل)
                                    $mainCategoryFieldName = 'name_' . $language->code;
                                    $mainCategoryName =
                                        $recipe->mainCategories->{$mainCategoryFieldName} ??
                                        ($recipe->mainCategories->name_ar ?? 'غير مترجم');
                                }
                                // ****************************************************
                            @endphp

                            <tr>
                                <td class="text-center text-muted fw-bold">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="language-info d-flex align-items-center">
                                        <img src="{{ $language->flag_image ? Storage::url($language->flag_image) : asset('assets/default-flag.png') }}"
                                            alt="{{ $language->name }}" class="flag-img rounded"
                                            style="width: 28px; height: 20px; margin-left: 8px; object-fit: cover;">
                                        <div>
                                            <div class="fw-semibold">{{ $language->name }}</div>
                                            <small class="text-muted">{{ strtoupper($language->code) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($recipe->chef)
                                        <div class="kitchen-info d-flex align-items-center">
                                            <i class="fas fa-user-chef text-primary"></i>
                                            <div class="chef-info d-flex align-items-center mt-2">
                                                @if ($recipe->chef->chefProfile && $recipe->chef->chefProfile->official_image)
                                                    <img src="{{ Storage::url($recipe->chef->chefProfile->official_image) }}"
                                                        alt="{{ $chefDisplayName }}" {{-- استخدام الاسم المترجم هنا أيضًا --}}
                                                        class="chef-img rounded-circle me-2"
                                                        style="width: 40px; height: 40px;">
                                                @else
                                                    <img src="{{ asset('assets/default-chef.png') }}" alt="صورة افتراضية"
                                                        class="chef-img rounded-circle me-2"
                                                        style="width: 40px; height: 40px;">
                                                @endif
                                                <span>{{ $chefDisplayName }}</span>
                                                {{-- **التعديل الثاني: عرض الاسم المترجم** --}}
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($recipe->kitchen)
                                        <div class="kitchen-info d-flex align-items-center">
                                            @if ($recipe->kitchen->image)
                                                <img src="{{ Storage::url($recipe->kitchen->image) }}"
                                                    alt="{{ $kitchenName }}" class="kitchen-img rounded-circle me-2"
                                                    style="width: 40px; height: 40px;">
                                            @else
                                                <img src="{{ asset('assets/default-kitchen.png') }}"
                                                    alt="صورة مطبخ افتراضي" class="kitchen-img rounded-circle me-2"
                                                    style="width: 40px; height: 40px;">
                                            @endif
                                            <span>{{ $kitchenName }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>

                                <td>
                                    {{-- **استخدم المتغير الذي تم تعريفه هنا** --}}
                                    @if ($recipe->mainCategories)
                                        {{-- استخدم اسم العلاقة من الموديل هنا --}}
                                        <div class="main-category-info d-flex align-items-center">
                                            @if ($recipe->mainCategories->image)
                                                <img src="{{ Storage::url($recipe->mainCategories->image) }}"
                                                    alt="{{ $mainCategoryName }}"
                                                    class="main-category-img rounded-circle me-2"
                                                    style="width: 40px; height: 40px;">
                                            @else
                                                <img src="{{ asset('assets/default-category.png') }}"
                                                    alt="صورة تصنيف افتراضي" class="main-category-img rounded-circle me-2"
                                                    style="width: 40px; height: 40px;">
                                            @endif
                                            <span>{{ $mainCategoryName }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($subCategoryNames))
                                        @foreach ($subCategoryNames as $name)
                                            <span class="badge bg-info me-1">{{ $name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $language->status == 0 ? 'غير فعال' : 'فعال' }}

                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.recipes.preview', ['recipe' => $recipe->id, 'lang_code' => $language->code]) }}"
                                            class="btn btn-outline-info btn-sm" id="icon-eye"  style="color: green; border: 1px solid green !important;" title="معاينة بـ{{ $language->name }}"><i
                                                class="fas fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted"><i class="fas fa-exclamation-circle fa-2x mb-2"></i>
                                        <p>لا توجد لغات متاحة</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('admin.recipes.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-right me-1"></i>
            العودة للقائمة</a>
        <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="btn btn-primary"><i
                class="fas fa-edit me-1"></i> تعديل الوصفة</a>
        <button type="button" class="btn btn-danger" onclick="deleteRecipe()"><i class="fas fa-trash me-1"></i> حذف
            الوصفة</button>
    </div>
@endsection

@push('scripts')
    <script>
        function deleteTranslation(langCode, langName) {
            if (confirm(`هل أنت متأكد من حذف ترجمة هذه الوصفة باللغة ${langName}؟`)) {
                fetch(`{{ route('admin.recipes.delete-translation', $recipe->id) }}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        lang_code: langCode
                    })
                }).then(response => response.json()).then(data => {
                    if (data.success) location.reload();
                    else alert('حدث خطأ أثناء حذف الترجمة');
                }).catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء حذف الترجمة');
                });
            }
        }

        function deleteRecipe() {
            if (confirm('هل أنت متأكد من حذف هذه الوصفة نهائياً؟ سيتم حذف جميع الترجمات المرتبطة بها.')) {
                document.getElementById('deleteRecipeForm').submit();
            }
        }
    </script>
    <form id="deleteRecipeForm" action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST"
        style="display: none;">
        @csrf @method('DELETE')
    </form>
@endpush

@push('styles')
    <style>
        .detail-item {
            /* border-bottom: 1px solid #eee; */
            padding-bottom: 0.5rem;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .recipe-number {
            background: #660099;
            padding: 1rem;
            border-radius: 0.5rem;
            color: white;
            text-align: center;
            margin-bottom: 1rem;
        }

        .table th {
            border-top: none;
            font-weight: 600;
        }

        .language-info {
            transition: all 0.2s ease;
        }

        .btn-group .btn {
            margin: 0 1px;
        }

        .progress {
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .category-img,
        .chef-img,
        .kitchen-img {
            object-fit: cover;
        }
    </style>
@endpush
