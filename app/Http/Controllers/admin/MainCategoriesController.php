<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class MainCategoriesController extends Controller
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
        $mainCategories = MainCategories::latest()->paginate(10);
        return view('admin.mainCategories.index', compact('mainCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255|unique:main_categories,name_ar',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $categoryData = [
            'name_ar' => $request->name_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new MainCategories())->getFillable())) {
                    $categoryData[$columnName] = $tr->setTarget($code)->translate($request->input('name_ar'));
                } else {
                    Log::warning("Column {$columnName} not found in MainCategories model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $categoryData[$columnName] = null;
                Log::error("Translation failed for {$code} (MainCategories Store): " . $e->getMessage());
            }
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('maincategories', 'public');
            $categoryData['image'] = $imagePath;
        }

        MainCategories::create($categoryData);

        return redirect()->route('admin.mainCategories.index')->with('success', 'تمت إضافة التصنيف الرئيسي بنجاح!');
    }

    public function show(MainCategories $mainCategory)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.mainCategories.show', compact('mainCategory', 'targetLanguages'));
    }

    public function edit(MainCategories $mainCategory)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.mainCategories.edit', compact('mainCategory', 'targetLanguages'));
    }

    public function update(Request $request, MainCategories $mainCategory)
    {
        $request->validate([
            'name_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('main_categories', 'name_ar')->ignore($mainCategory->id),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $categoryData = [
            'name_ar' => $request->name_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new MainCategories())->getFillable())) {
                    $categoryData[$columnName] = $tr->setTarget($code)->translate($request->input('name_ar'));
                } else {
                    Log::warning("Column {$columnName} not found in MainCategories model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $categoryData[$columnName] = null;
                Log::error("Translation failed for {$code} (MainCategories Update): " . $e->getMessage());
            }
        }

        if ($request->hasFile('image')) {
            if ($mainCategory->image) {
                Storage::disk('public')->delete($mainCategory->image);
            }
            $imagePath = $request->file('image')->store('maincategories', 'public');
            $categoryData['image'] = $imagePath;
        } elseif ($request->boolean('remove_image')) {
            if ($mainCategory->image) {
                Storage::disk('public')->delete($mainCategory->image);
                $categoryData['image'] = null;
            }
        }

        $mainCategory->update($categoryData);

        return redirect()->route('admin.mainCategories.index')->with('success', 'تم تحديث التصنيف الرئيسي بنجاح!');
    }

    public function destroy(MainCategories $mainCategory)
    {
        if ($mainCategory->image) {
            Storage::disk('public')->delete($mainCategory->image);
        }

        $mainCategory->delete();

        return redirect()->route('admin.mainCategories.index')->with('success', 'تم حذف التصنيف الرئيسي بنجاح!');
    }
}
