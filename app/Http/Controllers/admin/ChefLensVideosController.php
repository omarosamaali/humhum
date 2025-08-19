<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Snap;
use App\Models\User;
use App\Models\MainCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChefLensVideosController extends Controller
{
    public function index(Request $request)
    {
        $query = Snap::with(['user', 'mainCategory', 'kitchen']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('main_category_id', $request->category);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $videos = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = MainCategories::all();

        return view('admin.chefLensVideos.index', compact('videos', 'categories'));
    }

    public function create()
    {
        $categories = MainCategories::all();
        $chefs = User::where('role', 'طاه')->get();
        return view('admin.chefLensVideos.create', compact('categories', 'chefs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'video_path' => 'required|file|mimes:mp4,avi,mov|max:51200',
            'main_category_id' => 'required|exists:main_categories,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:active,inactive,pending'
        ]);

        $videoPath = null;
        if ($request->hasFile('video_path')) {
            $videoPath = $request->file('video_path')->store('chef_lens_videos', 'public');
        }

        Snap::create([
            'name' => $request->name,
            'video_path' => $videoPath,
            'main_category_id' => $request->main_category_id,
            'user_id' => $request->user_id,
            'status' => $request->status,
            'views' => 0,
            'likes' => 0,
            'bookmarks' => 0,
            'viewed_by' => [],
            'liked_by' => [],
            'bookmarked_by' => [],
        ]);

        return redirect()->route('admin.chefLensVideos.index')
            ->with('success', 'تم إضافة الفيديو بنجاح');
    }

    public function show(Snap $chefLensVideo)
    {
        $chefLensVideo->load(['user', 'mainCategory', 'kitchen', 'recipe', 'subCategories']);
        return view('admin.chefLensVideos.show', compact('chefLensVideo'));
    }

    public function edit(Snap $chefLensVideo)
    {
        $categories = MainCategories::all();
        $chefs = User::where('role', 'طاه')->get();
        return view('admin.chefLensVideos.edit', compact('chefLensVideo', 'categories', 'chefs'));
    }

    public function update(Request $request, Snap $chefLensVideo)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'video_path' => 'nullable|file|mimes:mp4,avi,mov|max:51200',
            'main_category_id' => 'required|exists:main_categories,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:active,inactive,pending'
        ]);

        $data = $request->except('video_path');

        if ($request->hasFile('video_path')) {
            if ($chefLensVideo->video_path) {
                Storage::disk('public')->delete($chefLensVideo->video_path);
            }
            $data['video_path'] = $request->file('video_path')->store('chef_lens_videos', 'public');
        }

        $chefLensVideo->update($data);

        return redirect()->route('admin.chefLensVideos.index')
            ->with('success', 'تم تحديث الفيديو بنجاح');
    }

    public function destroy(Snap $chefLensVideo)
    {
        if ($chefLensVideo->video_path) {
            Storage::disk('public')->delete($chefLensVideo->video_path);
        }

        $chefLensVideo->delete(); // حذف نهائي

        return redirect()->route('admin.chefLensVideos.index')
            ->with('success', 'تم حذف الفيديو نهائيًا');
    }
}
