<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Snap; // Import the Snap Model
use App\Models\Recipe; // Assuming you have this model
use App\Models\Kitchens; // Assuming you have this model
use App\Models\MainCategories; // Assuming you have this model
use App\Models\SubCategory; // Assuming you have this model


class SnapController extends Controller
{
    /**
     * Show the form for creating a new snap.
     * This method will handle displaying the view you provided.
     */
    public function create()
    {
        $recpies = Recipe::where('chef_id', Auth::user()->id)->get();
        $kitchens = Kitchens::all();
        $mainCategories = MainCategories::all();

        return view('c1he3f.snaps.add-snap', compact('recpies', 'kitchens', 'mainCategories'));
    }

    public function store(Request $request)
    {
        // 1. التحقق من صحة البيانات (Validation)
        $request->validate([
            'video' => 'required|file|mimetypes:video/mp4,video/quicktime,video/x-flv,video/x-ms-wmv,video/avi|max:50000', // 50000 كيلوبايت = 50 ميجابايت
            'name' => 'required|string|max:255',
            'kitchen_id' => 'required|exists:kitchens,id',
            'main_category_id' => 'required|exists:main_categories,id',
            // الأن، بما أنها مصفوفة مباشرة من الواجهة الأمامية
            'subCategory_ids' => 'nullable|array',
            'subCategory_ids.*' => 'exists:sub_categories,id', // يتحقق من وجود كل ID في جدول sub_categories
            'recipe_id' => 'nullable|exists:recipes,id',
            'status' => 'required|in:published,draft',
        ]);

        $videoPath = null;
        // 2. معالجة تحميل الفيديو
        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $videoPath = $videoFile->store('snaps', 'public');
        }

        // 3. إنشاء سجل جديد في قاعدة البيانات
        $snap = new Snap();
        $snap->name = $request->name;
        $snap->kitchen_id = $request->kitchen_id;
        $snap->main_category_id = $request->main_category_id;
        $snap->recipe_id = $request->recipe_id;
        $snap->status = $request->status;
        $snap->video_path = $videoPath;
        $snap->user_id = auth()->id(); 
        $snap->save(); // حفظ السناب في قاعدة البيانات

        // 4. ربط التصنيفات الفرعية (إذا تم اختيارها)
        // لا حاجة لـ json_decode() هنا. $request->subCategory_ids هي بالفعل مصفوفة
        if ($request->has('subCategory_ids') && is_array($request->subCategory_ids)) {
            $snap->subCategories()->attach($request->subCategory_ids);
        }
        // السطر أعلاه هو كل ما تحتاجه للتعامل مع الـ array
        // تأكد أن علاقة subCategories() مُعرفة بشكل صحيح في نموذج Snap الخاص بك
        // كمثال:
        // public function subCategories()
        // {
        //     return $this->belongsToMany(SubCategory::class, 'snap_sub_category', 'snap_id', 'sub_category_id');
        // }

        // 5. إعادة التوجيه مع رسالة نجاح
        return redirect()->route('c1he3f.snaps.all-snap')->with('success', 'تم إضافة السناب بنجاح!');
    }

    // app/Http/Controllers/SnapController.php
    public function getSubcategoryDetails($subCategoryId)
    {
        $subCategory = SubCategory::findOrFail($subCategoryId);
        return response()->json([
            'id' => $subCategory->id,
            'name_ar' => $subCategory->name_ar,
            'main_category_id' => $subCategory->category_id
        ]);
    }

    public function edit(Snap $snap)
    {
        $recpies = Recipe::where('chef_id', Auth::user()->id)->get();
        $kitchens = Kitchens::all();
        $mainCategories = MainCategories::all();

        // جلب التصنيفات الفرعية للتصنيف الرئيسي المحدد
        $subCategories = collect();
        if ($snap->main_category_id) {
            $subCategories = SubCategory::where('category_id', $snap->main_category_id)->get();
        }

        return view('c1he3f.snaps.edit-snap', compact('recpies', 'snap', 'kitchens', 'mainCategories', 'subCategories'));
    }

    public function update(Request $request, Snap $snap)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'video' => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/x-flv,video/x-ms-wmv,video/avi|max:50000',
            'name' => 'required|string|max:255',
            'kitchen_id' => 'required|exists:kitchens,id',
            'main_category_id' => 'required|exists:main_categories,id',
            'subCategory_ids' => 'nullable', // تغيير إلى nullable فقط، بدون array
            'recipe_id' => 'nullable|exists:recipes,id',
            'status' => 'required|in:published,draft',
        ]);

        // معالجة تحميل الفيديو
        if ($request->hasFile('video')) {
            if ($snap->video_path) {
                Storage::disk('public')->delete($snap->video_path);
            }
            $videoPath = $request->file('video')->store('snaps', 'public');
            $snap->video_path = $videoPath;
        }

        // تحديث البيانات الأساسية
        $snap->name = $request->name;
        $snap->kitchen_id = $request->kitchen_id;
        $snap->main_category_id = $request->main_category_id;
        $snap->recipe_id = $request->recipe_id;
        $snap->status = $request->status;
        $snap->save();

        // معالجة التصنيفات الفرعية
        if ($request->filled('subCategory_ids')) {
            // تحويل subCategory_ids إلى مصفوفة إذا كانت سلسلة نصية
            $subCategoryIds = is_array($request->subCategory_ids)
                ? $request->subCategory_ids
                : array_filter(explode(',', $request->subCategory_ids));

            // التحقق من أن جميع المعرفات موجودة في جدول sub_categories
            $validSubCategoryIds = SubCategory::whereIn('id', $subCategoryIds)->pluck('id')->toArray();
            $snap->subCategories()->sync($validSubCategoryIds);
        }
        // إذا لم يتم إرسال subCategory_ids، لا تقم بتغيير العلاقات

        return redirect()->route('c1he3f.snaps.all-snap')->with('success', 'تم تعديل السناب بنجاح!');
    }

    
    
    
    /**
     * Handle AJAX request for subcategories.
     */
    public function getSubcategories($mainCategoryId)
    {
        $subCategories = SubCategory::where('category_id', $mainCategoryId)->get();
        return response()->json($subCategories);
    }

    // app/Http/Controllers/SnapController.php

    public function destroy(Snap $snap)
    {
        // هنا ممكن تضيف كود لحذف الفيديو المرتبط بالـ snap من التخزين لو كان موجود
        // if ($snap->video_path) {
        //     Storage::disk('public')->delete($snap->video_path);
        // }

        $snap->delete();
        return redirect()->route('c1he3f.snaps.all-snap')->with('success', 'تم حذف السناب بنجاح!');
    }
}
