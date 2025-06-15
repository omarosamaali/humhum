<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    // اللغات المستهدفة للترجمة (باستثناء العربية التي لها حقلها الخاص)
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::latest()->paginate(10);
        // لا نحتاج لـ compact('targetLanguages') هنا ما دمنا لا نعرضها في نموذج الإضافة المضمن.
        // إذا أردت عرضها في نموذج الإضافة لتظهر كحقول read-only، فيمكنك إضافة السطر التالي:
        // $targetLanguages = $this->targetLanguages;
        // return view('admin.packages.index', compact('packages', 'targetLanguages'));
        return view('admin.packages.index', compact('packages'));
    }

    // دالة create() سيتم حذفها

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255|unique:packages,name_ar',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $packageData = [
            'name_ar' => $request->name_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar'); // ترجمة من العربية

        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code; // مثال: name_en, name_id
            try {
                // التحقق مما إذا كان حقل الترجمة متاحًا في الـ Model قبل محاولة التعيين
                if (in_array($columnName, (new Package())->getFillable())) {
                    $packageData[$columnName] = $tr->setTarget($code)->translate($request->input('name_ar'));
                } else {
                    Log::warning("Column {$columnName} not found in Package model fillable. Skipping translation for this column.");
                }
            } catch (\Exception $e) {
                $packageData[$columnName] = null;
                Log::error("Translation failed for {$code} (Package Store): " . $e->getMessage());
            }
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('packages', 'public');
            $packageData['image'] = $imagePath;
        }

        Package::create($packageData);

        return redirect()->route('admin.packages.index')->with('success', 'تمت إضافة الباقة بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        $targetLanguages = $this->targetLanguages; // لتمريرها وعرض الترجمات في صفحة العرض
        return view('admin.packages.show', compact('package', 'targetLanguages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.packages.edit', compact('package', 'targetLanguages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255|unique:packages,name_ar,' . $package->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $packageData = [
            'name_ar' => $request->name_ar,
            'status' => $request->status,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new Package())->getFillable())) {
                    $packageData[$columnName] = $tr->setTarget($code)->translate($request->input('name_ar'));
                } else {
                    Log::warning("Column {$columnName} not found in Package model fillable. Skipping translation for this column.");
                }
            } catch (\Exception $e) {
                $packageData[$columnName] = null;
                Log::error("Translation failed for {$code} (Package Update): " . $e->getMessage());
            }
        }

        if ($request->hasFile('image')) {
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            $imagePath = $request->file('image')->store('packages', 'public');
            $packageData['image'] = $imagePath;
        } elseif ($request->boolean('remove_image')) {
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
                $packageData['image'] = null;
            }
        }

        $package->update($packageData);

        return redirect()->route('admin.packages.index')->with('success', 'تم تحديث الباقة بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }

        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'تم حذف الباقة بنجاح!');
    }
}
