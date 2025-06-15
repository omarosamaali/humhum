<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kitchens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class KitchensController extends Controller
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
        $kitchens = Kitchens::latest()->paginate(10);
        return view('admin.kitchens.index', compact('kitchens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255|unique:kitchens,name_ar',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $kitchensData = [
            'name_ar' => $request->name_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new Kitchens())->getFillable())) {
                    $kitchensData[$columnName] = $tr->setTarget($code)->translate($request->input('name_ar'));
                } else {
                    Log::warning("Column {$columnName} not found in Main Kitchens model fillable. Skipping translation for this column.");
                }
            } catch (\Exception $e) {
                $kitchensData[$columnName] = null;
                Log::error("Translation failed for {$code} ( Kitchens Store): " . $e->getMessage());
            }
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('kitchens', 'public');
            $kitchensData['image'] = $imagePath;
        }

        Kitchens::create($kitchensData);

        return redirect()->route('admin.kitchens.index')->with('success', 'تمت إضافة المبطخ بنجاح!');
    }

    public function show(Kitchens $kitchen)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.kitchens.show', compact('kitchen', 'targetLanguages'));
    }

    public function edit(Kitchens $kitchen)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.kitchens.edit', compact('kitchen', 'targetLanguages'));
    }

    public function update(Request $request, Kitchens $kitchen)
    {
        $request->validate([
            'name_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kitchens', 'name_ar')->ignore($kitchen->id),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $kitchensData = [
            'name_ar' => $request->name_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new Kitchens())->getFillable())) {
                    $kitchensData[$columnName] = $tr->setTarget($code)->translate($request->input('name_ar'));
                } else {
                    Log::warning("Column {$columnName} not found in Main Kitchens model fillable. Skipping translation for this column.");
                }
            } catch (\Exception $e) {
                $kitchensData[$columnName] = null;
                Log::error("Translation failed for {$code} (Main Kitchens Update): " . $e->getMessage());
            }
        }

        if ($request->hasFile('image')) {
            if ($kitchen->image) {
                Storage::disk('public')->delete($kitchen->image);
            }
            $imagePath = $request->file('image')->store('kitchens', 'public');
            $kitchensData['image'] = $imagePath;
        } elseif ($request->boolean('remove_image')) {
            if ($kitchen->image) {
                Storage::disk('public')->delete($kitchen->image);
                $kitchensData['image'] = null;
            }
        }

        $kitchen->update($kitchensData);

        return redirect()->route('admin.kitchens.index', $kitchen->id)->with('success', 'تم تحديث المطبخ بنجاح!');
    }

    public function destroy(Kitchens $kitchen)
    {
        if ($kitchen->image) {
            Storage::disk('public')->delete($kitchen->image);
        }

        $kitchen->delete();

        return redirect()->route('admin.kitchens.index')->with('success', 'تم حذف المبطخ بنجاح!');
    }
}
