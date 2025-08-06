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
        $request->validate([
            'video' => 'required|file|mimetypes:video/mp4,video/quicktime,video/x-flv,video/x-ms-wmv,video/avi|max:50000',
            'name' => 'required|string|max:255',
            'kitchen_id' => 'nullable|exists:kitchens,id',
            'main_category_id' => 'nullable|exists:main_categories,id',
            'subCategory_ids' => 'nullable|array',
            'subCategory_ids.*' => 'exists:sub_categories,id',
            'recipe_id' => 'nullable|exists:recipes,id',
            'status' => 'required|in:published,draft',
        ]);

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('snaps', 'public');
        }

        $snap = new Snap();
        $snap->name = $request->name;
        $snap->kitchen_id = $request->kitchen_id;
        $snap->main_category_id = $request->main_category_id;
        $snap->recipe_id = $request->recipe_id;
        $snap->status = $request->status;
        $snap->video_path = $videoPath;
        $snap->user_id = auth()->id();
        $snap->save();

        if ($request->has('subCategory_ids') && is_array($request->subCategory_ids)) {
            $snap->subCategories()->sync($request->subCategory_ids);
        }

        // إرجاع استجابة JSON للـ AJAX
        return response()->json(['success' => true, 'message' => 'تم إضافة السناب بنجاح!']);
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
            'kitchen_id' => 'nullable|exists:kitchens,id',
            'main_category_id' => 'nullable|exists:main_categories,id',
            'subCategory_ids' => 'nullable',
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
     */ /**
     * Handle AJAX request for subcategories.
     */
    public function getSubcategories($mainCategoryId)
    {
        // إضافة debugging logs
        \Log::info("=== Starting getSubcategories ===");
        \Log::info("Received mainCategoryId: " . $mainCategoryId);

        try {
            // التحقق من المعرف
            if (!is_numeric($mainCategoryId) || $mainCategoryId <= 0) {
                \Log::error("Invalid mainCategoryId: {$mainCategoryId}");
                return response()->json(['error' => 'Invalid category ID'], 400);
            }

            // التحقق من وجود التصنيف الرئيسي
            $mainCategoryExists = \DB::table('main_categories')->where('id', $mainCategoryId)->exists();
            \Log::info("Main category exists: " . ($mainCategoryExists ? 'Yes' : 'No'));

            if (!$mainCategoryExists) {
                \Log::error("Main category not found for ID: {$mainCategoryId}");
                return response()->json(['error' => 'Main category not found'], 404);
            }

            // جلب التصنيفات الفرعية باستخدام DB مباشرة للتأكد
            $subCategories = \DB::table('sub_categories')
                ->where('category_id', $mainCategoryId)
                ->select('id', 'name_ar', 'category_id')
                ->get();

            \Log::info("Found subcategories count: " . $subCategories->count());
            \Log::info("Subcategories data: " . json_encode($subCategories));

            // محاولة أيضاً مع Model
            try {
                $modelSubCategories = SubCategory::where('category_id', $mainCategoryId)->get();
                \Log::info("Model subcategories count: " . $modelSubCategories->count());
            } catch (\Exception $e) {
                \Log::error("Model query failed: " . $e->getMessage());
            }

            // التحقق من أسماء الأعمدة
            $tableSchema = \DB::select("DESCRIBE sub_categories");
            \Log::info("Sub_categories table schema: " . json_encode($tableSchema));

            return response()->json($subCategories);
        } catch (\Exception $e) {
            \Log::error("Exception in getSubcategories: " . $e->getMessage());
            \Log::error("Stack trace: " . $e->getTraceAsString());

            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // دالة إضافية للتشخيص
    public function debugDatabase()
    {
        \Log::info("=== Database Debug ===");

        // فحص جداول قاعدة البيانات
        $tables = \DB::select("SHOW TABLES");
        \Log::info("Available tables: " . json_encode($tables));

        // فحص التصنيفات الرئيسية
        $mainCategories = \DB::table('main_categories')->get();
        \Log::info("Main categories: " . json_encode($mainCategories));

        // فحص التصنيفات الفرعية
        $subCategories = \DB::table('sub_categories')->get();
        \Log::info("Sub categories: " . json_encode($subCategories));

        return response()->json([
            'main_categories' => $mainCategories,
            'sub_categories' => $subCategories
        ]);
    }
    
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
