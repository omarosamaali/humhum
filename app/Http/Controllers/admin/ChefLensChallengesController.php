<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChefLensChallengesController extends Controller
{
    public function index(Request $request)
    {
        // تم تغيير النموذج من Snap إلى Challenge
        $query = Challenge::with(['chef', 'recipe']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('message', 'like', '%' . $request->search . '%')
                ->orWhereHas('recipe', function ($q) use ($request) {
                    $q->where('name_ar', 'like', '%' . $request->search . '%');
                });
        }

        // تم تغيير اسم المتغير من $videos إلى $challenges ليكون أوضح
        $challenges = $query->orderBy('start_date', 'desc')->paginate(10);

        // تم تغيير اسم العرض من chefLensVideos.index إلى chefLensChallenges.index
        return view('admin.chefLensChallenges.index', compact('challenges'));
    }

    public function create()
    {
        $chefs = User::where('role', 'طاه')->get();
        // ستحتاج إلى جلب الوصفات إذا كنت تريد ربط التحدي بوصفة
        // $recipes = Recipe::all();
        return view('admin.chefLensChallenges.create', compact('chefs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'announcement_path' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov|max:51200',
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => 'required|date_format:H:i',
            'recipe_id' => 'nullable|exists:recipes,id',
            'price' => 'nullable|numeric',
            'challenge_type' => 'required|in:individual,group',
            'status' => 'required|in:active,inactive,pending',
            'chef_id' => 'required|exists:users,id',
            'prize_type' => 'required|in:highest_rating,top_three,all_participants,none',
            'prize_name' => 'nullable|string|max:255',
            'prize_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $announcementPath = null;
        if ($request->hasFile('announcement_path')) {
            $announcementPath = $request->file('announcement_path')->store('chef_lens_challenges', 'public');
        }

        $prizeImage = null;
        if ($request->hasFile('prize_image')) {
            $prizeImage = $request->file('prize_image')->store('challenge_prizes', 'public');
        }

        Challenge::create([
            'announcement_path' => $announcementPath,
            'message' => $request->message,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
            'recipe_id' => $request->recipe_id,
            'price' => $request->price,
            'challenge_type' => $request->challenge_type,
            'status' => $request->status,
            'chef_id' => $request->chef_id,
            'prize_type' => $request->prize_type,
            'prize_name' => $request->prize_name,
            'prize_image' => $prizeImage,
        ]);

        return redirect()->route('admin.chefLensChallenges.index')
            ->with('success', 'تم إضافة التحدي بنجاح');
    }

    public function show(Challenge $chefLensChallenge)
    {
        $chefLensChallenge->load(['chef', 'recipe']);
        return view('admin.chefLensChallenges.show', compact('chefLensChallenge'));
    }

    public function edit(Challenge $chefLensChallenge)
    {
        $chefs = User::where('role', 'طاه')->get();
        return view('admin.chefLensChallenges.edit', compact('chefLensChallenge', 'chefs'));
    }

    public function update(Request $request, Challenge $chefLensChallenge)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'announcement_path' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov|max:51200',
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => 'required|date_format:H:i',
            'recipe_id' => 'nullable|exists:recipes,id',
            'price' => 'nullable|numeric',
            'challenge_type' => 'required|in:individual,group',
            'status' => 'required|in:active,inactive,pending',
            'chef_id' => 'required|exists:users,id',
            'prize_type' => 'required|in:highest_rating,top_three,all_participants,none',
            'prize_name' => 'nullable|string|max:255',
            'prize_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['announcement_path', 'prize_image']);

        if ($request->hasFile('announcement_path')) {
            if ($chefLensChallenge->announcement_path) {
                Storage::disk('public')->delete($chefLensChallenge->announcement_path);
            }
            $data['announcement_path'] = $request->file('announcement_path')->store('chef_lens_challenges', 'public');
        }

        if ($request->hasFile('prize_image')) {
            if ($chefLensChallenge->prize_image) {
                Storage::disk('public')->delete($chefLensChallenge->prize_image);
            }
            $data['prize_image'] = $request->file('prize_image')->store('challenge_prizes', 'public');
        }

        $chefLensChallenge->update($data);

        return redirect()->route('admin.chefLensChallenges.index')
            ->with('success', 'تم تحديث التحدي بنجاح');
    }

    public function destroy(Challenge $chefLensChallenge)
    {
        if ($chefLensChallenge->announcement_path) {
            Storage::disk('public')->delete($chefLensChallenge->announcement_path);
        }

        if ($chefLensChallenge->prize_image) {
            Storage::disk('public')->delete($chefLensChallenge->prize_image);
        }

        $chefLensChallenge->delete();

        return redirect()->route('admin.chefLensChallenges.index')
            ->with('success', 'تم حذف التحدي نهائيًا');
    }
}
