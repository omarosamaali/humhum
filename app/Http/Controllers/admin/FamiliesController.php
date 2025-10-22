<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FamiliesController extends Controller
{
    public function index()
    {
        $families = Family::latest()->paginate(10);
        return view('admin.families.index', compact('families'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $familyData = [
            'status' => $request->status,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('families', 'public');
            $familyData['image'] = $imagePath;
        }

        Family::create($familyData);

        return redirect()->route('admin.families.index')->with('success', 'تمت إضافة العائلة بنجاح!');
    }

    public function show(Family $family)
    {
        return view('admin.families.show', compact('family'));
    }

    public function edit(Family $family)
    {
        return view('admin.families.edit', compact('family'));
    }

    public function update(Request $request, Family $family)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $familyData = [
            'status' => $request->status,
        ];

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
