<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LanguageController extends Controller
{
    /**
     * Display a listing of the languages.
     * سيعرض جميع اللغات المعرفة في ملف config، مع جلب حالتها من قاعدة البيانات
     */
    public function index()
    {
        // جلب جميع اللغات الثابتة من ملف config
        $allConfigLanguages = config('app_languages.list'); // استخدم المسار الصحيح لملف config

        // جلب اللغات الموجودة في قاعدة البيانات (حالة وصورة)
        $dbLanguages = Language::all()->keyBy('code');

        $languages = [];
        foreach ($allConfigLanguages as $code => $name) {
            // دمج البيانات: إذا كانت اللغة موجودة في DB، استخدم بياناتها، وإلا فاجعلها غير فعالة وبدون صورة
            $lang = $dbLanguages->get($code);

            $languages[] = (object) [ // تحويل المصفوفة إلى كائن لسهولة الوصول في Blade
                'id' => $lang ? $lang->id : null, // ID إذا كانت موجودة في DB
                'name' => $name, // الاسم من ملف config
                'code' => $code, // الكود من ملف config
                'flag_image' => $lang ? $lang->flag_image : null,
                'status' => $lang ? $lang->status : 0, // الافتراضي هو 0 (غير فعال) إذا لم تكن في DB
                'created_at' => $lang ? $lang->created_at : null,
                'updated_at' => $lang ? $lang->updated_at : null,
                // Accessors for Blade (سنحتاج لعملها يدوياً أو تكييفها)
                'status_text' => $lang ? ($lang->status ? 'فعال' : 'غير فعال') : 'غير فعال',
                'status_badge_class' => $lang ? ($lang->status ? 'bg-success' : 'bg-danger') : 'bg-danger',
                'flag_image_url' => $lang ? $lang->flag_image_url : asset('assets/img/logo.svg'),
            ];
        }

        // يمكنك فرز اللغات هنا إذا أردت (مثلاً حسب الاسم أو الكود)
        // usort($languages, fn($a, $b) => strcmp($a->name, $b->name));

        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for editing the specified language.
     * هنا، $code ليس بالضرورة ID، بل هو كود اللغة (مثل 'ar', 'en')
     */
    public function edit(string $code) // تم تغييرها لاستقبال الكود بدلاً من Language model
    {
        $languageData = config('app_languages.list')[$code] ?? null;

        if (!$languageData) {
            abort(404, 'Language not found.');
        }

        $language = Language::where('code', $code)->first();

        // إذا لم تكن اللغة موجودة في DB، قم بإنشاء كائن مؤقت لعرضه في الفورم
        if (!$language) {
            $language = new Language([
                'code' => $code,
                'name' => $languageData,
                'flag_image' => null,
                'status' => 0, // الافتراضي غير فعال
            ]);
        }

        // بما أننا لا نستخدم قائمة Google Languages للاختيار، فلا داعي لـ $googleLanguages
        return view('admin.languages.edit', compact('language'));
    }

    /**
     * Update the specified language in storage.
     */
    public function update(Request $request, string $code) // تم تغييرها لاستقبال الكود
    {
        $languageData = config('app_languages.list')[$code] ?? null;

        if (!$languageData) {
            return redirect()->route('admin.languages.index')
                ->with('error', 'اللغة غير موجودة.');
        }

        $request->validate([
            // لا حاجة لـ validation لـ name/code لأنها ثابتة
            'flag_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean', // فقط الحالة والصورة تتغير
            'remove_flag_image' => 'nullable|boolean', // لإزالة الصورة
        ], [
            'flag_image.image' => 'الرجاء تحميل ملف صورة صالح.',
            'flag_image.mimes' => 'صيغ الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
            'flag_image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
            'status.required' => 'حقل الحالة مطلوب.',
            'status.boolean' => 'قيمة الحالة غير صالحة.',
        ]);

        // ابحث عن اللغة في قاعدة البيانات أو أنشئها إذا لم تكن موجودة
        $language = Language::firstOrNew(['code' => $code]);
        $language->name = $languageData; // تأكد من تحديث الاسم أيضاً من config

        $data = [
            'status' => $request->status,
        ];

        if ($request->hasFile('flag_image')) {
            if ($language->flag_image) {
                Storage::disk('public')->delete($language->flag_image);
            }
            $data['flag_image'] = $request->file('flag_image')->store('flags', 'public');
        } elseif ($request->boolean('remove_flag_image')) {
            if ($language->flag_image) {
                Storage::disk('public')->delete($language->flag_image);
            }
            $data['flag_image'] = null;
        }

        $language->fill($data); // Fill the attributes
        $language->save(); // Save (this will either create or update)

        return redirect()->route('admin.languages.index')
            ->with('success', 'تم تحديث اللغة بنجاح.');
    }

    /**
     * لا توجد دالة store هنا، لأن اللغات لا تُضاف من قبل الأدمن
     */
    // public function store(Request $request) { ... }

    /**
     * لا توجد دالة destroy هنا، لأن اللغات لا تُحذف من قبل الأدمن
     */
    // public function destroy(Language $language) { ... }

    /**
     * Display the specified language. (Show page - يمكن إزالته إذا لم تعد بحاجة لصفحة عرض تفاصيل منفصلة)
     */
    public function show(string $code)
    {
        $languageData = config('app_languages.list')[$code] ?? null;

        if (!$languageData) {
            abort(404, 'Language not found.');
        }

        $language = Language::where('code', $code)->first();

        // إذا لم تكن اللغة موجودة في DB، قم بإنشاء كائن مؤقت لعرضه
        if (!$language) {
            $language = new Language([
                'code' => $code,
                'name' => $languageData,
                'flag_image' => null,
                'status' => 0, // الافتراضي غير فعال
            ]);
            // لضمان عمل الـ accessors مثل getStatusTextAttribute() و getFlagImageUrlAttribute()
            // ستحتاج إلى تعيينها يدوياً أو تعديل الـ model ليعمل مع الكائنات التي لم تحفظ بعد.
            // لتبسيط الأمر في الـ view، يمكننا إضافة هذه الخصائص هنا:
            $language->status_text = 'غير فعال';
            $language->status_badge_class = 'bg-danger';
            $language->flag_image_url = asset('assets/img/logo.svg');
        }

        return view('admin.languages.show', compact('language'));
    }
}
