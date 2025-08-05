<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Food;
use App\Models\Types;
use App\Models\Terms;
use App\Models\Hosp; // تأكد أن هذا هو الموديل الصحيح لسياسة الضيافة
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule; // لإضافة validation rule

class AboutUsController extends Controller
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
     * Display a listing of the resource for AboutUs, Terms, and Hosp.
     * لعرض قائمة بالموارد لكل من "معلومات عنا" و "اتفاقية الاستخدام" و "سياسة الضيافة"
     */
    public function index()
    {
        $aboutUs = AboutUs::first();
        $terms = Terms::first();
        $hosp = Hosp::first(); // جلب سجل سياسة الضيافة
        $food = Food::first(); // جلب سجل سياسة الضيافة
        $types = Types::first(); // جلب سجل سياسة الضيافة

        // قم بتمرير جميع المتغيرات إلى الـ View
        return view('admin.about-us.index', compact('aboutUs', 'terms', 'hosp', 'food','types'));
    }

    // -----------------------------------------------------------
    // Methods for AboutUs (معلومات عنا) - (لم يتم تغييرها، فقط للاكتمال)
    // -----------------------------------------------------------

    /**
     * Show the form for creating a new AboutUs resource.
     * عرض نموذج إنشاء مورد "معلومات عنا" جديد.
     */
    public function create()
    {
        $aboutUs = AboutUs::first();
        if ($aboutUs) {
            return redirect()->route('admin.about-us.edit', $aboutUs->id);
        }
        return view('admin.about-us.create');
    }

    /**
     * Store a newly created AboutUs resource in storage.
     * تخزين مورد "معلومات عنا" تم إنشاؤه حديثًا في التخزين.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255|unique:about_us,title_ar',
            'description_ar' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $aboutUsData = [
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code;
            $descColumn = 'description_' . $code;
            try {
                if (in_array($titleColumn, (new AboutUs())->getFillable())) {
                    $aboutUsData[$titleColumn] = $tr->setTarget($code)->translate($request->title_ar);
                    $aboutUsData[$descColumn] = $tr->setTarget($code)->translate($request->description_ar);
                } else {
                    Log::warning("Columns {$titleColumn} or {$descColumn} not found in AboutUs model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $aboutUsData[$titleColumn] = null;
                $aboutUsData[$descColumn] = null;
                Log::error("Translation failed for {$code} (AboutUs Store): " . $e->getMessage());
            }
        }

        if ($request->hasFile('main_image')) {
            $aboutUsData['main_image'] = $request->file('main_image')->store('about-us/main', 'public');
        }

        if ($request->hasFile('sub_image')) {
            $aboutUsData['sub_image'] = $request->file('sub_image')->store('about-us/sub', 'public');
        }

        AboutUs::create($aboutUsData);

        return redirect()->route('admin.about-us.index')->with('success', 'تمت إضافة محتوى صفحة "معلومات عنا" بنجاح!');
    }

    /**
     * Display the specified AboutUs resource.
     * عرض مورد "معلومات عنا" المحدد.
     */
    public function show($about_u)
    {
        $aboutUs = AboutUs::findOrFail($about_u);
        $targetLanguages = $this->targetLanguages;
        return view('admin.about-us.show', compact('aboutUs', 'targetLanguages'));
    }

    /**
     * Show the form for editing the specified AboutUs resource.
     * عرض نموذج تعديل مورد "معلومات عنا" المحدد.
     */
    public function edit($about_u)
    {
        $aboutUs = AboutUs::findOrFail($about_u);
        $targetLanguages = $this->targetLanguages;
        return view('admin.about-us.edit', compact('aboutUs', 'targetLanguages'));
    }

    /**
     * Update the specified AboutUs resource in storage.
     * تحديث مورد "معلومات عنا" المحدد في التخزين.
     */
    public function update(Request $request, $about_u)
    {
        $aboutUs = AboutUs::findOrFail($about_u);

        $request->validate([
            'title_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('about_us', 'title_ar')->ignore($aboutUs->id),
            ],
            'description_ar' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $aboutUsData = [
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code;
            $descColumn = 'description_' . $code;
            try {
                if (in_array($titleColumn, (new AboutUs())->getFillable())) {
                    $aboutUsData[$titleColumn] = $tr->setTarget($code)->translate($request->title_ar);
                    $aboutUsData[$descColumn] = $tr->setTarget($code)->translate($request->description_ar);
                } else {
                    Log::warning("Columns {$titleColumn} or {$descColumn} not found in AboutUs model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $aboutUsData[$titleColumn] = null;
                $aboutUsData[$descColumn] = null;
                Log::error("Translation failed for {$code} (AboutUs Update): " . $e->getMessage());
            }
        }

        if ($request->hasFile('main_image')) {
            if ($aboutUs->main_image) {
                Storage::disk('public')->delete($aboutUs->main_image);
            }
            $aboutUsData['main_image'] = $request->file('main_image')->store('about-us/main', 'public');
        } elseif ($request->boolean('remove_main_image')) {
            if ($aboutUs->main_image) {
                Storage::disk('public')->delete($aboutUs->main_image);
                $aboutUsData['main_image'] = null;
            }
        }

        if ($request->hasFile('sub_image')) {
            if ($aboutUs->sub_image) {
                Storage::disk('public')->delete($aboutUs->sub_image);
            }
            $aboutUsData['sub_image'] = $request->file('sub_image')->store('about-us/sub', 'public');
        } elseif ($request->boolean('remove_sub_image')) {
            if ($aboutUs->sub_image) {
                Storage::disk('public')->delete($aboutUs->sub_image);
                $aboutUsData['sub_image'] = null;
            }
        }

        $aboutUs->update($aboutUsData);

        return redirect()->route('admin.about-us.index')->with('success', 'تم تحديث محتوى صفحة "معلومات عنا" بنجاح!');
    }

    /**
     * Remove the specified AboutUs resource from storage.
     * إزالة مورد "معلومات عنا" المحدد من التخزين.
     */
    public function destroy(AboutUs $aboutUs)
    {
        if ($aboutUs->main_image) {
            Storage::disk('public')->delete($aboutUs->main_image);
        }
        if ($aboutUs->sub_image) {
            Storage::disk('public')->delete($aboutUs->sub_image);
        }

        $aboutUs->delete();

        return redirect()->route('admin.about-us.index')->with('success', 'تم حذف محتوى صفحة "معلومات عنا" بنجاح!');
    }

    // -----------------------------------------------------------
    // Methods for Terms (اتفاقية الاستخدام) - (لم يتم تغييرها، فقط للاكتمال)
    // -----------------------------------------------------------

    /**
     * Show the form for creating a new Terms resource.
     * عرض نموذج إنشاء مورد "اتفاقية الاستخدام" جديد.
     */
    public function createTerms()
    {
        $terms = Terms::first();
        if ($terms) {
            return redirect()->route('admin.terms.edit', $terms->id);
        }
        return view('admin.terms.create');
    }

    /**
     * Store a newly created Terms resource in storage.
     * تخزين مورد "اتفاقية الاستخدام" تم إنشاؤه حديثًا في التخزين.
     */
    public function storeTerms(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:terms_of_use,title', // 'title' بناءً على migration الجدول
            'content_ar' => 'required|string',
            'is_active' => 'required|boolean',
            'version' => 'required|integer|min:1',
        ]);

        $termsData = [
            'title' => $request->title,
            'content_ar' => $request->content_ar,
            'is_active' => $request->is_active,
            'version' => $request->version,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code;
            $contentColumn = 'content_' . $code;
            try {
                if (in_array($titleColumn, (new Terms())->getFillable())) {
                    $termsData[$titleColumn] = $tr->setTarget($code)->translate($request->title);
                    $termsData[$contentColumn] = $tr->setTarget($code)->translate($request->content_ar);
                } else {
                    Log::warning("Columns {$titleColumn} or {$contentColumn} not found in Terms model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $termsData[$titleColumn] = null;
                $termsData[$contentColumn] = null;
                Log::error("Translation failed for {$code} (Terms Store): " . $e->getMessage());
            }
        }

        Terms::create($termsData);

        return redirect()->route('admin.terms.index')->with('success', 'تمت إضافة اتفاقية الاستخدام بنجاح!');
    }

    /**
     * Display the specified Terms resource.
     * عرض مورد "اتفاقية الاستخدام" المحدد.
     */
    public function showTerms($termId)
    {
        $terms = Terms::findOrFail($termId);
        $targetLanguages = $this->targetLanguages;
        return view('admin.terms.show', compact('terms', 'targetLanguages'));
    }

    /**
     * Show the form for editing the specified Terms resource.
     * عرض نموذج تعديل مورد "اتفاقية الاستخدام" المحدد.
     */
    public function editTerms($termId)
    {
        $terms = Terms::findOrFail($termId);
        $targetLanguages = $this->targetLanguages;
        return view('admin.terms.edit', compact('terms', 'targetLanguages'));
    }

    /**
     * Update the specified Terms resource in storage.
     * تحديث مورد "اتفاقية الاستخدام" المحدد في التخزين.
     */
    public function updateTerms(Request $request, $termId)
    {
        $terms = Terms::findOrFail($termId);

        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('terms_of_use', 'title')->ignore($terms->id),
            ],
            'content_ar' => 'required|string',
            'is_active' => 'required|boolean',
            'version' => 'required|integer|min:1',
        ]);

        $termsData = [
            'title' => $request->title,
            'content_ar' => $request->content_ar,
            'is_active' => $request->is_active,
            'version' => $request->version,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code;
            $contentColumn = 'content_' . $code;
            try {
                if (in_array($titleColumn, (new Terms())->getFillable())) {
                    $termsData[$titleColumn] = $tr->setTarget($code)->translate($request->title);
                    $termsData[$contentColumn] = $tr->setTarget($code)->translate($request->content_ar);
                } else {
                    Log::warning("Columns {$titleColumn} or {$contentColumn} not found in Terms model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $termsData[$titleColumn] = null;
                $termsData[$contentColumn] = null;
                Log::error("Translation failed for {$code} (Terms Update): " . $e->getMessage());
            }
        }

        $terms->update($termsData);

        return redirect()->route('admin.terms.index')->with('success', 'تم تحديث اتفاقية الاستخدام بنجاح!');
    }

    /**
     * Remove the specified Terms resource from storage.
     * إزالة مورد "اتفاقية الاستخدام" المحدد من التخزين.
     */
    public function destroyTerms($termId)
    {
        $terms = Terms::findOrFail($termId);
        $terms->delete();
        return redirect()->route('admin.terms.index')->with('success', 'تم حذف اتفاقية الاستخدام بنجاح!');
    }

    // -----------------------------------------------------------
    // New Methods for Hosp (سياسة الضيافة)
    // -----------------------------------------------------------

    /**
     * Show the form for creating a new Hosp resource.
     * عرض نموذج إنشاء مورد "سياسة الضيافة" جديد.
     */
    public function createHosp()
    {
        $hosp = Hosp::first();
        if ($hosp) {
            // إذا كان هناك سجل "سياسة الضيافة" موجود بالفعل، قم بتحويل المستخدم لصفحة التعديل
            return redirect()->route('admin.hosp.edit', $hosp->id);
        }
        return view('admin.hosp.create'); // تحتاج لإنشاء هذا الـ View
    }

    /**
     * Store a newly created Hosp resource in storage.
     * تخزين مورد "سياسة الضيافة" تم إنشاؤه حديثًا في التخزين.
     */
    public function storeHosp(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:hospitality_policies,title', // بناءً على Migration المقترحة لـ hospitality_policies
            'content_ar' => 'required|string',
            'is_active' => 'required|boolean',
            'version' => 'required|integer|min:1',
        ]);

        $hospData = [
            'title' => $request->title,
            'content_ar' => $request->content_ar,
            'is_active' => $request->is_active,
            'version' => $request->version,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code; // إذا كان لديك أعمدة title_en, title_id, إلخ في Hosp
            $contentColumn = 'content_' . $code; // إذا كان لديك أعمدة content_en, content_id, إلخ في Hosp
            try {
                // التأكد من أن الأعمدة قابلة للملء في Hosp Model
                if (in_array($titleColumn, (new Hosp())->getFillable())) {
                    // ترجمة العنوان والمحتوى
                    $hospData[$titleColumn] = $tr->setTarget($code)->translate($request->title);
                    $hospData[$contentColumn] = $tr->setTarget($code)->translate($request->content_ar);
                } else {
                    Log::warning("Columns {$titleColumn} or {$contentColumn} not found in Hosp model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $hospData[$titleColumn] = null;
                $hospData[$contentColumn] = null;
                Log::error("Translation failed for {$code} (Hosp Store): " . $e->getMessage());
            }
        }

        Hosp::create($hospData);

        return redirect()->route('admin.hosp.index')->with('success', 'تمت إضافة سياسة الضيافة بنجاح!');
    }

    /**
     * Display the specified Hosp resource.
     * عرض مورد "سياسة الضيافة" المحدد.
     */
    public function showHosp($hospId)
    {
        $hosp = Hosp::findOrFail($hospId);
        $targetLanguages = $this->targetLanguages;
        return view('admin.hosp.show', compact('hosp', 'targetLanguages')); // تحتاج لإنشاء هذا الـ View
    }

    /**
     * Show the form for editing the specified Hosp resource.
     * عرض نموذج تعديل مورد "سياسة الضيافة" المحدد.
     */
    public function editHosp($hospId)
    {
        $hosp = Hosp::findOrFail($hospId);
        $targetLanguages = $this->targetLanguages;
        return view('admin.hosp.edit', compact('hosp', 'targetLanguages')); // تحتاج لإنشاء هذا الـ View
    }

    /**
     * Update the specified Hosp resource in storage.
     * تحديث مورد "سياسة الضيافة" المحدد في التخزين.
     */
    public function updateHosp(Request $request, $hospId)
    {
        $hosp = Hosp::findOrFail($hospId);

        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('hospitality_policies', 'title')->ignore($hosp->id),
            ],
            'content_ar' => 'required|string',
            'is_active' => 'required|boolean',
            'version' => 'required|integer|min:1',
        ]);

        $hospData = [
            'title' => $request->title,
            'content_ar' => $request->content_ar,
            'is_active' => $request->is_active,
            'version' => $request->version,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code;
            $contentColumn = 'content_' . $code;
            try {
                if (in_array($titleColumn, (new Hosp())->getFillable())) {
                    $hospData[$titleColumn] = $tr->setTarget($code)->translate($request->title);
                    $hospData[$contentColumn] = $tr->setTarget($code)->translate($request->content_ar);
                } else {
                    Log::warning("Columns {$titleColumn} or {$contentColumn} not found in Hosp model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $hospData[$titleColumn] = null;
                $hospData[$contentColumn] = null;
                Log::error("Translation failed for {$code} (Hosp Update): " . $e->getMessage());
            }
        }

        $hosp->update($hospData);

        return redirect()->route('admin.hosp.index')->with('success', 'تم تحديث سياسة الضيافة بنجاح!');
    }

    /**
     * Remove the specified Hosp resource from storage.
     * إزالة مورد "سياسة الضيافة" المحدد من التخزين.
     */
    public function destroyHosp($hospId)
    {
        $hosp = Hosp::findOrFail($hospId);
        $hosp->delete();
        return redirect()->route('admin.hosp.index')->with('success', 'تم حذف سياسة الضيافة بنجاح!');
    }
}
