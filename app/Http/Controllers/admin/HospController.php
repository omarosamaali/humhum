<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hosp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;

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
        $aboutUs = Hosp::findOrFail($about_u);

        $request->validate([
            'title_ar' => 'required|string|max:255|unique:about_us,title_ar,' . $aboutUs->id,
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
