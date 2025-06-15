<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // تأكد من تضمين هذا
use App\Models\Plan; // موديل الخطة
use App\Models\Package; // موديل الباقة
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate; // مكتبة الترجمة

class PlanController extends Controller
{
    /**
     * عرض قائمة بجميع الخطط.
     */
    public function index()
    {
        $plans = Plan::with('package')->paginate(10); // جلب الخطط مع الباقة المرتبطة وتصفحها
        $packages = Package::all(); // جلب جميع الباقات لنموذج الإضافة/التعديل

        return view('admin.plans.index', compact('plans', 'packages'));
    }

    /**
     * عرض نموذج إنشاء خطة جديدة.
     */
    public function create()
    {
        // لا حاجة لـ create view منفصلة لأنها جزء من index
        return redirect()->route('admin.plans.index');
    }

    /**
     * تخزين خطة جديدة في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'name_ar' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_unit' => 'required|string|in:1 شهر,3 شهور,6 شهور,12 شهر',
            'status' => 'required|boolean',
        ]);

        // تهيئة مترجم Google Translate
        $tr = new GoogleTranslate();

        // تجهيز بيانات الخطة، بدءاً بالبيانات المباشرة من الطلب
        $planData = $request->all();

        // ترجمة الاسم العربي إلى اللغات الأخرى
        $planData['name_en'] = $tr->setSource('ar')->setTarget('en')->translate($request->name_ar);
        $planData['name_id'] = $tr->setSource('ar')->setTarget('id')->translate($request->name_ar);
        $planData['name_am'] = $tr->setSource('ar')->setTarget('am')->translate($request->name_ar);
        $planData['name_hi'] = $tr->setSource('ar')->setTarget('hi')->translate($request->name_ar);
        $planData['name_bn'] = $tr->setSource('ar')->setTarget('bn')->translate($request->name_ar);
        $planData['name_ml'] = $tr->setSource('ar')->setTarget('ml')->translate($request->name_ar);
        $planData['name_fil'] = $tr->setSource('ar')->setTarget('fil')->translate($request->name_ar);
        $planData['name_ur'] = $tr->setSource('ar')->setTarget('ur')->translate($request->name_ar);
        $planData['name_ta'] = $tr->setSource('ar')->setTarget('ta')->translate($request->name_ar);
        $planData['name_ne'] = $tr->setSource('ar')->setTarget('ne')->translate($request->name_ar);
        $planData['name_ps'] = $tr->setSource('ar')->setTarget('ps')->translate($request->name_ar);


        // إنشاء الخطة في قاعدة البيانات
        Plan::create($planData);

        return redirect()->route('admin.plans.index')->with('success', 'تمت إضافة الخطة بنجاح!');
    }

    /**
     * عرض تفاصيل خطة معينة.
     */
    public function show(Plan $plan)
    {
        // تحميل الباقة المرتبطة لعرض تفاصيلها
        $plan->load('package');
        return view('admin.plans.show', compact('plan'));
    }

    /**
     * عرض نموذج تعديل خطة معينة.
     */
    public function edit(Plan $plan)
    {
        // جلب جميع الباقات لنموذج التعديل
        $packages = Package::all();
        return view('admin.plans.edit', compact('plan', 'packages'));
    }

    /**
     * تحديث خطة معينة في قاعدة البيانات.
     */
    public function update(Request $request, Plan $plan)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'name_ar' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_unit' => 'required|string|in:1 شهر,3 شهور,6 شهور,12 شهر',
            'status' => 'required|boolean',
        ]);

        // تهيئة مترجم Google Translate
        $tr = new GoogleTranslate();

        // تجهيز بيانات التحديث
        $planData = $request->all();

        // إذا تغير الاسم العربي، قم بإعادة الترجمة
        if ($plan->name_ar !== $request->name_ar) {
            $planData['name_en'] = $tr->setSource('ar')->setTarget('en')->translate($request->name_ar);
            $planData['name_id'] = $tr->setSource('ar')->setTarget('id')->translate($request->name_ar);
            $planData['name_am'] = $tr->setSource('ar')->setTarget('am')->translate($request->name_ar);
            $planData['name_hi'] = $tr->setSource('ar')->setTarget('hi')->translate($request->name_ar);
            $planData['name_bn'] = $tr->setSource('ar')->setTarget('bn')->translate($request->name_ar);
            $planData['name_ml'] = $tr->setSource('ar')->setTarget('ml')->translate($request->name_ar);
            $planData['name_fil'] = $tr->setSource('ar')->setTarget('fil')->translate($request->name_ar);
            $planData['name_ur'] = $tr->setSource('ar')->setTarget('ur')->translate($request->name_ar);
            $planData['name_ta'] = $tr->setSource('ar')->setTarget('ta')->translate($request->name_ar);
            $planData['name_ne'] = $tr->setSource('ar')->setTarget('ne')->translate($request->name_ar);
            $planData['name_ps'] = $tr->setSource('ar')->setTarget('ps')->translate($request->name_ar);
        } else {
            // إذا لم يتغير الاسم العربي، احتفظ بالترجمات الموجودة لتجنب الترجمة غير الضرورية
            $planData['name_en'] = $plan->name_en;
            $planData['name_id'] = $plan->name_id;
            $planData['name_am'] = $plan->name_am;
            $planData['name_hi'] = $plan->name_hi;
            $planData['name_bn'] = $plan->name_bn;
            $planData['name_ml'] = $plan->name_ml;
            $planData['name_fil'] = $plan->name_fil;
            $planData['name_ur'] = $plan->name_ur;
            $planData['name_ta'] = $plan->name_ta;
            $planData['name_ne'] = $plan->name_ne;
            $planData['name_ps'] = $plan->name_ps;
        }


        // تحديث الخطة في قاعدة البيانات
        $plan->update($planData);

        return redirect()->route('admin.plans.index')->with('success', 'تم تحديث الخطة بنجاح!');
    }

    /**
     * حذف خطة معينة من قاعدة البيانات.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'تم حذف الخطة بنجاح!');
    }
}
