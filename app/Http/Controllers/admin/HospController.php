<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hosp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

use Illuminate\Validation\Rule; // <<--- تأكد من وجود هذا السطر

class HospController extends Controller
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

    public function index()
    {
        $hosp = Hosp::first();
        return view('admin.about-us.index', compact('hosp'));
    }

    public function create()
    {
        $hosp = Hosp::first();
        if ($hosp) {
            return redirect()->route('admin.hosp.edit', $hosp->id);
        }
        return view('admin.hosp.create');
    }

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
                if (in_array($titleColumn, (new Hosp())->getFillable())) {
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

        Hosp::create($aboutUsData);

        return redirect()->route('admin.about-us.index')->with('success', 'تمت إضافة محتوى صفحة "معلومات عنا" بنجاح!');
    }
    public function show($about_u)
    {
        $hosp = Hosp::findOrFail($about_u);
        $targetLanguages = $this->targetLanguages;
        return view('admin.hosp.show', compact('hosp', 'targetLanguages'));
    }

    public function edit($about_u)
    {
        $hosp = Hosp::findOrFail($about_u);
        $targetLanguages = $this->targetLanguages;
        return view('admin.hosp.edit', compact('hosp', 'targetLanguages'));
    }
    public function update(Request $request, $about_u)
    {
        // جلب السجل باستخدام المتغير $about_u وتعيينه إلى $aboutUs كما هو لديك
        $aboutUs = Hosp::findOrFail($about_u);

        $validatedData = $request->validate([ // تم تغيير $request->validate مباشرة إلى $validatedData
            // تأكد أن 'about_us' هو اسم الجدول الصحيح إذا كان هذا الكود يخص 'about_us'
            // إذا كان يخص 'hosp' فيجب أن يكون 'hosp' هنا. بناءً على FindOrFail(Hosp) فالأغلب أنها 'hosp'.
            'title_ar' => ['required', 'string', 'max:255', Rule::unique('hosp', 'title_ar')->ignore($aboutUs->id)], // تم تعديل about_us إلى hosp هنا
            'description_ar' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            // **إضافة قواعد التحقق للصور الجديدة**
            'calc_nutrition_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nutrition_label_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_calc_nutrition_image' => 'nullable|boolean',
            'remove_nutrition_label_image' => 'nullable|boolean',
        ]);

        // بما أنك تستخدم $validatedData الآن، يمكن تبسيط $aboutUsData
        // سنبدأ بـ $aboutUsData بما لديك، ثم نملأه من $validatedData
        $aboutUsData = [
            'title_ar' => $validatedData['title_ar'],
            'description_ar' => $validatedData['description_ar'],
            'status' => $validatedData['status'],
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code;
            $descColumn = 'description_' . $code;
            try {
                // استخدام Schema::hasColumn للتحقق من وجود العمود
                if (Schema::hasColumn('hosp', $titleColumn)) { // استخدام اسم الجدول 'hosp'
                    $aboutUsData[$titleColumn] = $tr->setTarget($code)->translate($validatedData['title_ar']);
                } else {
                    Log::warning("Column {$titleColumn} not found in 'hosp' table. Skipping translation for title.");
                }

                if (Schema::hasColumn('hosp', $descColumn)) { // استخدام اسم الجدول 'hosp'
                    $aboutUsData[$descColumn] = $tr->setTarget($code)->translate($validatedData['description_ar']);
                } else {
                    Log::warning("Column {$descColumn} not found in 'hosp' table. Skipping translation for description.");
                }

            } catch (\Exception $e) {
                if (Schema::hasColumn('hosp', $titleColumn)) {
                    $aboutUsData[$titleColumn] = null;
                }
                if (Schema::hasColumn('hosp', $descColumn)) {
                    $aboutUsData[$descColumn] = null;
                }
                Log::error("Translation failed for {$code} (Hosp Update): " . $e->getMessage());
            }
        }

        // التعامل مع main_image و sub_image كما هو لديك
        if ($request->hasFile('main_image')) {
            if ($aboutUs->main_image) {
                Storage::disk('public')->delete($aboutUs->main_image);
            }
            $aboutUsData['main_image'] = $request->file('main_image')->store('about-us/main', 'public');
        } elseif ($request->boolean('remove_main_image')) {
            if ($aboutUs->main_image) {
                Storage::disk('public')->delete($aboutUs->main_image);
            }
            $aboutUsData['main_image'] = null;
        } else {
            // احتفظ بالصورة القديمة إذا لم يتم رفع جديد ولم يتم طلب الحذف
            $aboutUsData['main_image'] = $aboutUs->main_image;
        }


        if ($request->hasFile('sub_image')) {
            if ($aboutUs->sub_image) {
                Storage::disk('public')->delete($aboutUs->sub_image);
            }
            $aboutUsData['sub_image'] = $request->file('sub_image')->store('about-us/sub', 'public');
        } elseif ($request->boolean('remove_sub_image')) {
            if ($aboutUs->sub_image) {
                Storage::disk('public')->delete($aboutUs->sub_image);
            }
            $aboutUsData['sub_image'] = null;
        } else {
            // احتفظ بالصورة القديمة إذا لم يتم رفع جديد ولم يتم طلب الحذف
            $aboutUsData['sub_image'] = $aboutUs->sub_image;
        }

        // **التعامل مع الصورة الأولى: calc_nutrition_image**
        if ($request->hasFile('calc_nutrition_image')) {
            if ($aboutUs->calc_nutrition_image) { // استخدام $aboutUs
                Storage::disk('public')->delete($aboutUs->calc_nutrition_image);
            }
            $aboutUsData['calc_nutrition_image'] = $request->file('calc_nutrition_image')->store('hosp_images', 'public');
        } elseif ($request->boolean('remove_calc_nutrition_image')) { // استخدام request->boolean() للحصول على قيمة منطقية
            if ($aboutUs->calc_nutrition_image) { // استخدام $aboutUs
                Storage::disk('public')->delete($aboutUs->calc_nutrition_image);
            }
            $aboutUsData['calc_nutrition_image'] = null;
        } else {
            // احتفظ بالصورة القديمة إذا لم يتم رفع جديد ولم يتم طلب الحذف
            $aboutUsData['calc_nutrition_image'] = $aboutUs->calc_nutrition_image;
        }


        // **التعامل مع الصورة الثانية: nutrition_label_image**
        if ($request->hasFile('nutrition_label_image')) {
            if ($aboutUs->nutrition_label_image) { // استخدام $aboutUs
                Storage::disk('public')->delete($aboutUs->nutrition_label_image);
            }
            $aboutUsData['nutrition_label_image'] = $request->file('nutrition_label_image')->store('hosp_images', 'public');
        } elseif ($request->boolean('remove_nutrition_label_image')) { // استخدام request->boolean()
            if ($aboutUs->nutrition_label_image) { // استخدام $aboutUs
                Storage::disk('public')->delete($aboutUs->nutrition_label_image);
            }
            $aboutUsData['nutrition_label_image'] = null;
        } else {
            // احتفظ بالصورة القديمة إذا لم يتم رفع جديد ولم يتم طلب الحذف
            $aboutUsData['nutrition_label_image'] = $aboutUs->nutrition_label_image;
        }

        // تحديث السجل باستخدام $aboutUsData
        $aboutUs->update($aboutUsData);

        // إعادة التوجيه
        return redirect()->route('admin.about-us.index')->with('success', 'تم تحديث محتوى صفحة "معلومات عنا" بنجاح!');
    }


    public function destroy(hosp $aboutUs)
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
}
