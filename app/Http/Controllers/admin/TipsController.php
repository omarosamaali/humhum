<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TipsController extends Controller
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
        $tips = Tip::latest()->paginate(10);
        return view('admin.tips.index', compact('tips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255|unique:tips,name_ar',
            'status' => 'required|boolean',
        ]);

        $tipData = [
            'name_ar' => $request->name_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new Tip())->getFillable())) {
                    $tipData[$columnName] = $tr->setTarget($code)->translate($request->input('name_ar'));
                } else {
                    Log::warning("Column {$columnName} not found in Tip model fillable. Skipping translation for this column.");
                }
            } catch (\Exception $e) {
                $tipData[$columnName] = null;
                Log::error("Translation failed for {$code} (Tip Store): " . $e->getMessage());
            }
        }

        Tip::create($tipData);

        return redirect()->route('admin.tips.index')->with('success', 'تمت إضافة الإرشاد بنجاح!');
    }

    public function show(Tip $tip)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.tips.show', compact('tip', 'targetLanguages'));
    }

    public function edit(Tip $tip)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.tips.edit', compact('tip', 'targetLanguages'));
    }

    public function update(Request $request, Tip $tip)
    {
        $request->validate([
            'name_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tips', 'name_ar')->ignore($tip->id),
            ],
            'status' => 'required|boolean',
        ]);

        $tipData = [
            'name_ar' => $request->name_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new Tip())->getFillable())) {
                    $tipData[$columnName] = $tr->setTarget($code)->translate($request->input('name_ar'));
                } else {
                    Log::warning("Column {$columnName} not found in Tip model fillable. Skipping translation for this column.");
                }
            } catch (\Exception $e) {
                $tipData[$columnName] = null;
                Log::error("Translation failed for {$code} (Tip Update): " . $e->getMessage());
            }
        }

        $tip->update($tipData);

        return redirect()->route('admin.tips.index')->with('success', 'تم تحديث الإرشاد بنجاح!');
    }

    public function destroy(Tip $tip)
    {
        $tip->delete();

        return redirect()->route('admin.tips.index')->with('success', 'تم حذف الإرشاد بنجاح!');
    }
}
