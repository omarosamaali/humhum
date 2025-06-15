<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class FamiliesController extends Controller
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
        $families = Family::latest()->paginate(10);
        return view('admin.families.index', compact('families'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255|unique:families,name_ar',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $familyData = [
            'name_ar' => $request->name_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new Family())->getFillable())) {
                    $familyData[$columnName] = $tr->setTarget($code)->translate($request->input('name_ar'));
                } else {
                    Log::warning("Column {$columnName} not found in Family model fillable. Skipping translation for this column.");
                }
            } catch (\Exception $e) {
                $familyData[$columnName] = null;
                Log::error("Translation failed for {$code} (Family Store): " . $e->getMessage());
            }
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('families', 'public');
            $familyData['image'] = $imagePath;
        }

        Family::create($familyData);

        return redirect()->route('admin.families.index')->with('success', 'تمت إضافة العائلة بنجاح!');
    }

    public function show(Family $family)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.families.show', compact('family', 'targetLanguages'));
    }

    public function edit(Family $family)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.families.edit', compact('family', 'targetLanguages'));
    }

    public function update(Request $request, Family $family)
    {
        $request->validate([
            'name_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('families', 'name_ar')->ignore($family->id),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $familyData = [
            'name_ar' => $request->name_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new Family())->getFillable())) {
                    $familyData[$columnName] = $tr->setTarget($code)->translate($request->input('name_ar'));
                } else {
                    Log::warning("Column {$columnName} not found in Family model fillable. Skipping translation for this column.");
                }
            } catch (\Exception $e) {
                $familyData[$columnName] = null;
                Log::error("Translation failed for {$code} (Family Update): " . $e->getMessage());
            }
        }

        if ($request->hasFile('image')) {
            if ($family->image) {
                Storage::disk('public')->delete($family->image);
            }
            $imagePath = $request->file('image')->store('families', 'public');
            $familyData['image'] = $imagePath;
        } elseif ($request->boolean('remove_image')) {
            if ($family->image) {
                Storage::disk('public')->delete($family->image);
                $familyData['image'] = null;
            }
        }

        $family->update($familyData);

        return redirect()->route('admin.families.index')->with('success', 'تم تحديث العائلة بنجاح!');
    }

    public function destroy(Family $family)
    {
        if ($family->image) {
            Storage::disk('public')->delete($family->image);
        }

        $family->delete();

        return redirect()->route('admin.families.index')->with('success', 'تم حذف العائلة بنجاح!');
    }
}
