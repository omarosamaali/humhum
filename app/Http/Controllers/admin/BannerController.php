<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BannerController extends Controller
{
    /**
     * Display a listing of the banners.
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new banner.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created banner in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'display_location' => 'required|in:website,mobile_app',
            'status' => 'required|boolean',
        ]);

        // التحقق من عدم وجود تضارب في التواريخ
        $this->validateDateConflict($request->start_date, $request->end_date, $request->display_location);

        $data = $request->except(['_token']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/banners', 'public');
        }

        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'تم إضافة البانر بنجاح.');
    }

    /**
     * Display the specified banner.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\View\View
     */
    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified banner.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\View\View
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified banner in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'display_location' => 'required|in:website,mobile_app',
            'status' => 'required|boolean',
            'remove_image' => 'nullable|boolean',
        ]);

        // التحقق من عدم وجود تضارب في التواريخ (باستثناء البانر الحالي)
        $this->validateDateConflict($request->start_date, $request->end_date, $request->display_location, $banner->id);

        $data = $request->except(['_token', '_method']);

        // Handle image update/removal
        if ($request->has('remove_image') && $request->input('remove_image')) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
                $data['image'] = null;
            }
        } elseif ($request->hasFile('image')) {
            // If a new image is uploaded, delete the old one
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $data['image'] = $request->file('image')->store('uploads/banners', 'public');
        } else {
            // If no new image, and no removal, retain the old image path
            $data['image'] = $banner->image;
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'تم تحديث البانر بنجاح.');
    }

    /**
     * Remove the specified banner from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'تم حذف البانر بنجاح.');
    }

    /**
     * التحقق من عدم وجود تضارب في تواريخ البانرات
     *
     * @param string|null $startDate
     * @param string|null $endDate
     * @param string $displayLocation
     * @param int|null $excludeId
     * @return void
     */
    private function validateDateConflict($startDate, $endDate, $displayLocation, $excludeId = null)
    {
        // إذا لم يتم تحديد تاريخ البداية، لا نحتاج للتحقق
        if (!$startDate) {
            return;
        }

        // إذا لم يتم تحديد تاريخ النهاية، نعتبر أن البانر يعمل إلى ما لا نهاية
        $endDate = $endDate ?: '2099-12-31';

        // البحث عن البانرات المتضاربة
        $query = Banner::where('display_location', $displayLocation)
            ->where('status', true) // التحقق فقط من البانرات النشطة
            ->where(function ($q) use ($startDate, $endDate) {
                $q->where(function ($subQ) use ($startDate, $endDate) {
                    // حالة 1: تاريخ البداية الجديد يقع ضمن فترة بانر موجود
                    $subQ->where('start_date', '<=', $startDate)
                        ->where(function ($dateQ) use ($startDate) {
                            $dateQ->whereNull('end_date')
                                ->orWhere('end_date', '>=', $startDate);
                        });
                })->orWhere(function ($subQ) use ($startDate, $endDate) {
                    // حالة 2: تاريخ النهاية الجديد يقع ضمن فترة بانر موجود
                    $subQ->where('start_date', '<=', $endDate)
                        ->where(function ($dateQ) use ($endDate) {
                            $dateQ->whereNull('end_date')
                                ->orWhere('end_date', '>=', $endDate);
                        });
                })->orWhere(function ($subQ) use ($startDate, $endDate) {
                    // حالة 3: الفترة الجديدة تحتوي على بانر موجود بالكامل
                    $subQ->where('start_date', '>=', $startDate)
                        ->where(function ($dateQ) use ($endDate) {
                            $dateQ->where('end_date', '<=', $endDate)
                                ->orWhereNull('end_date');
                        });
                });
            });

        // استبعاد البانر الحالي في حالة التحديث
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $conflictingBanner = $query->first();

        if ($conflictingBanner) {
            $conflictStart = $conflictingBanner->start_date ? date('Y-m-d', strtotime($conflictingBanner->start_date)) : 'غير محدد';
            $conflictEnd = $conflictingBanner->end_date ? date('Y-m-d', strtotime($conflictingBanner->end_date)) : 'مفتوح';

            // استخدام طريقة أبسط لإرسال رسالة الخطأ
            $errorMessage = "يوجد بانر آخر نشط في نفس موقع العرض ({$displayLocation}) خلال هذه الفترة الزمنية. البانر المتضارب من {$conflictStart} إلى {$conflictEnd}";

            throw \Illuminate\Validation\ValidationException::withMessages([
                'start_date' => [$errorMessage]
            ]);
        }
    }
}
