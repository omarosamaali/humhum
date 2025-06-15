<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategories;
use App\Models\SubCategory;
use App\Models\MainCategory; // استدعاء موديل MainCategory
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class SubCategoryController extends Controller
{
    protected $targetLanguages = [
        'id' => 'الإندونيسية',
        'am' => 'الأمهرية',
        'hi' => 'الهندية',
        'bn' => 'البنغالية',
        'ml' => 'المالايالامية',
        'fil' => 'الفلبينية',
        'ur' => 'الأردية',
        'ta' => 'التاميلية',
        'en' => 'الإنجليزية',
        'ne' => 'النيبالية',
        'ps' => 'الأفغانية',
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainCategories = MainCategories::all(); // لجلب جميع التصنيفات الرئيسية

        // عرض قائمة التصنيفات الفرعية مع التصنيف الرئيسي المرتبط بها
        $subCategories = SubCategory::with('mainCategory')->latest()->paginate(10);
        return view('admin.subCategories.index', compact('subCategories', 'mainCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // عرض نموذج إنشاء تصنيف فرعي جديد
        $mainCategories = MainCategories::all(); // لجلب جميع التصنيفات الرئيسية
        return view('admin.subCategories.create', compact('mainCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'category_id' => 'required|exists:main_categories,id',
            'name_ar' => 'required|string|max:255',
            // لا نحتاج لـ required على حقول الترجمة الأخرى إذا كانت ستتم تلقائياً
            'name_en' => 'nullable|string|max:255', // يمكن أن تستقبل من الفورم إذا أردت يدوياً
            'name_id' => 'nullable|string|max:255',
            // ... بقية اللغات
            'status' => 'required|boolean',
        ]);

        $subCategoryData = [
            'category_id' => $request->category_id,
            'name_ar' => $request->name_ar,
            'status' => $request->input('status'), // التعديل السابق
        ];

        $tr = new GoogleTranslate('ar'); // ترجمة من العربية

        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                // التحقق مما إذا كان حقل الترجمة متاحًا في الـ Model قبل محاولة التعيين
                if (in_array($columnName, (new SubCategory())->getFillable())) {
                    $subCategoryData[$columnName] = $tr->setTarget($code)->translate($request->input('name_ar'));
                } else {
                    Log::warning("Column {$columnName} not found in SubCategory model fillable. Skipping translation for this column.");
                }
            } catch (\Exception $e) {
                $subCategoryData[$columnName] = null; // تعيين null في حالة فشل الترجمة
                Log::error("Translation failed for {$code} (SubCategory Store): " . $e->getMessage());
            }
        }

        SubCategory::create($subCategoryData);

        return redirect()->route('admin.subCategories.index')
            ->with('success', 'تم إنشاء التصنيف الفرعي بنجاح.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'category_id' => 'required|exists:main_categories,id',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_id' => 'nullable|string|max:255',
            // ... بقية اللغات
            'status' => 'boolean',
        ]);

        $subCategoryData = [
            'category_id' => $request->category_id,
            'name_ar' => $request->name_ar,
            'status' => $request->input('status'),
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new SubCategory())->getFillable())) {
                    $subCategoryData[$columnName] = $tr->setTarget($code)->translate($request->input('name_ar'));
                } else {
                    Log::warning("Column {$columnName} not found in SubCategory model fillable. Skipping translation for this column.");
                }
            } catch (\Exception $e) {
                $subCategoryData[$columnName] = null;
                Log::error("Translation failed for {$code} (SubCategory Update): " . $e->getMessage());
            }
        }

        $subCategory->update($subCategoryData);

        return redirect()->route('admin.subCategories.index')
            ->with('success', 'تم تحديث التصنيف الفرعي بنجاح.');
    }



/**
 * Display the specified resource.
 */
    public function show(SubCategory $subCategory)
    {
        // عرض تفاصيل تصنيف فرعي واحد
        return view('admin.subCategories.show', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        // عرض نموذج تعديل تصنيف فرعي
        $targetLanguages = $this->targetLanguages;

        $mainCategories = MainCategories::all();
        return view('admin.subCategories.edit', compact('subCategory', 'mainCategories', 'targetLanguages'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, SubCategory $subCategory)
    // {
    //     // التحقق من صحة البيانات المدخلة وتحديث التصنيف الفرعي
    //     $request->validate([
    //         'category_id' => 'required|exists:main_categories,id',
    //         'name_ar' => 'required|string|max:255',
    //         'name_en' => 'nullable|string|max:255',
    //         'name_id' => 'nullable|string|max:255',
    //         'name_am' => 'nullable|string|max:255',
    //         'name_hi' => 'nullable|string|max:255',
    //         'name_bn' => 'nullable|string|max:255',
    //         'name_ml' => 'nullable|string|max:255',
    //         'name_fil' => 'nullable|string|max:255',
    //         'name_ur' => 'nullable|string|max:255',
    //         'name_ta' => 'nullable|string|max:255',
    //         'name_ne' => 'nullable|string|max:255',
    //         'name_ps' => 'nullable|string|max:255',
    //         'status' => 'boolean',
    //     ]);

    //     $data = $request->all();
    //     // قم بتعيين قيمة status مباشرة من request
    //     // بما أننا نعلم أن 0 = فعال و 1 = غير فعال من الـ select box
    //     $data['status'] = $request->input('status'); // سيأخذ القيمة 0 أو 1 مباشرة

    //     $subCategory->update($data);

    //     return redirect()->route('admin.subCategories.index')
    //         ->with('success', 'تم تحديث التصنيف الفرعي بنجاح.');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();

        return redirect()->route('admin.subCategories.index')
            ->with('success', 'تم حذف التصنيف الفرعي بنجاح.');
    }
}
