<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Auth;
use App\Models\Challenge;
use App\Models\Recipe;
use App\Models\Snap;
use App\Models\Faq;
use App\Http\Controllers\ChallengeController;
use App\Models\ChefProfile;
use App\Http\Controllers\FollowController;
use App\Models\Report;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ChefLensUserController;
use App\Http\Controllers\Admin\ChefLensVideosController;
use App\Http\Controllers\Admin\ChefLensChallengesController;

Route::get('/chef_lens/welcome', [VideoController::class, 'guestIndex'])->name('welcome');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(
    function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::resource('chefLensUsers', ChefLensUserController::class);
        Route::resource('chefLensVideos', ChefLensVideosController::class);
        Route::resource('chefLensChallenges', ChefLensChallengesController::class);
    }
);

Route::get('/chef_lens/about', function () {
    $about = AboutUs::latest()->first();
    return view('/chef_lens/about', compact('about'));
})->name('chef_lens.about');

Route::post('/chef-profile/{chefId}/report', function (Request $request, $chefId) {
    if (!auth()->check()) {
        return response()->json(['success' => false, 'message' => 'يجب تسجيل الدخول للإبلاغ.'], 401);
    }

    try {
        Report::create([
            'user_id' => auth()->id(),
            'chef_id' => $chefId,
            // '' => \App\Models\User::class, // تم تعديل هذا السطر
            'report_type' => $request->input('report_type'),
        ]);

        return response()->json(['success' => true, 'message' => 'تم استلام بلاغك بنجاح.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'فشل في حفظ البلاغ.'], 500);
    }
})->middleware('auth');

Route::get('chef_lens/challenges/{challenge_id}/add-vs', function ($challenge_id) {

    $challenge = Challenge::with(['chef', 'chefProfile', 'recipe'])->findOrFail($challenge_id);
    return view('chef_lens.challenges.add-vs', compact('challenge'));
})->name('chef_lens.add-vs');

Route::post('chef_lens/challenges/{challenge_id}/submit-response', [ChallengeController::class, 'submitResponseUserChef'])
    ->name('chef_lens.submit-response');

    Route::get('challenges/{challenge}', function($id) {
    $challenge = Challenge::with('chefProfile', 'recipe')->withCount('responses')->findOrFail($id);
    $challengeAccepted = $challenge->responses()->exists();
    return view('chef_lens.challenges.show', compact('challenge', 'challengeAccepted'));
})->name('chef_lens.challenges.show');

Route::get('challenges', function () {
    $challenges = Challenge::withCount('responses')->get();
    return view('chef_lens.challenges.challenges', compact('challenges'));
})->name('chef_lens.challenges');


Route::post('chef-profile/{chefProfile}/toggle-follow', [FollowController::class, 'toggleFollow'])->name('chef.toggle-follow');

Route::post('chef-profile/report-by-user/{userId}', function (Request $request, $userId) {
    $request->validate([
        'report_type' => 'required|in:content_report,fake_account'
    ]);

    // Find the ChefProfile by user_id
    $chefProfile = ChefProfile::where('user_id', $userId)->first();

    if (!$chefProfile) {
        return response()->json([
            'success' => false,
            'message' => 'الملف الشخصي للشيف غير موجود'
        ], 404);
    }

    // Check if the user has already reported this chef profile
    $existingReport = Report::where('user_id', auth()->id())
        ->where('chef_profile_id', $chefProfile->id) // Use chef_profile_id (id from chef_profiles)
        ->first();

    if ($existingReport) {
        return response()->json([
            'success' => false,
            'message' => 'لقد قمت بالإبلاغ عن هذا الحساب من قبل'
        ]);
    }

    Report::create([
        'user_id' => auth()->id(),
        'chef_profile_id' => $chefProfile->id, // Use the id from chef_profiles
        'report_type' => $request->report_type,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'تم إرسال البلاغ بنجاح'
    ]);
})->name('chef.report.by.user');
Route::get('challenge/profileDisplayed/{chefProfile}', function (ChefProfile $chefProfile) {

    $userReported = false;
    if (auth()->check()) {
        $userReported = Report::where('user_id', auth()->id())
            ->where('chef_profile_id', $chefProfile->id) // Use id from chef_profiles
            ->exists();
    }

    $challangeCount = Challenge::where('user_id', $chefProfile->user_id)->count();
    $likesCount = Snap::where('user_id', $chefProfile->user_id)->sum('likes') + Challenge::where('user_id', $chefProfile->user_id)->sum('likes');
    $snapsWithOutRecpies = Snap::where('recipe_id', null)->get();
    $snapsWithRecpies = Snap::where('recipe_id', '!=', null)->get();
    $challanges = Challenge::where('user_id', $chefProfile->user_id)->get();
    $snapsCount = Snap::where('user_id', $chefProfile->user_id)->count();

    // Get social media links for the chef
    $socialMedia = \App\Models\SocialMedia::where('user_id', $chefProfile->user_id)
        ->where('is_active', true)
        ->first();

    return view('chef_lens.challenges.profileDisplayed', compact(
        'userReported',
        'snapsCount',
        'challanges',
        'snapsWithRecpies',
        'snapsWithOutRecpies',
        'chefProfile',
        'challangeCount',
        'likesCount',
        'socialMedia'
    ));
})->name('chef_lens.profileDisplayed');
Route::get('admin/reports/{report}', [ReportController::class, 'show'])->name('admin.reports.show');
Route::get('challenges-own', [ChallengeController::class, 'challengesOwn'])
    ->name('chef_lens.challenge.challenges-own');
Route::post('admin/reports/{report}/send-message', [ReportController::class, 'sendMessage'])->name('admin.reports.send-message');
Route::get('chef_lens/faq', function () {
    $faqs = Faq::where('place', 'user')->get();
    return view('chef_lens.faq', compact('faqs'));
})->name('chef_lens.faq');

Route::get('chef_lens/edit-profile', function () {
    $user = Auth::user();
    return view('chef_lens.profile.edit-profile', compact('user'));
})->name('chef_lens.edit-profile');

Route::get('chef_lens/profile', function () {
    $user = Auth::user();

    // Tab 1: Snaps اللي عملها لايك وميكنوش ليها وصفة مرتبطة
    $snapsWithOutRecipes = Snap::whereJsonContains('liked_by', $user->id)
        ->whereNull('recipe_id') // أو whereDoesntHave('recipe') لو عندك relation
        ->whereNotNull('video_path')
        ->get();

    // Tab 2: التحديات اللي قبلها (من جدول challenges_responses)
    $acceptedChallenges = Challenge::whereHas('responses', function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })->whereNotNull('announcement_path')->get();

    // Tab 3: Snaps مع الوصفات اللي عملها لايك
    $snapsWithRecipes = Snap::whereJsonContains('liked_by', $user->id)
        ->whereNotNull('recipe_id') // أو whereHas('recipe') لو عندك relation
        ->whereNotNull('video_path')
        ->with('recipe') // لجلب الوصفة المرتبطة
        ->get();

    return view('chef_lens.profile.index', compact(
        'user',
        'snapsWithOutRecipes',
        'acceptedChallenges',
        'snapsWithRecipes'
    ));
})->name('chef_lens.profile');
Route::get('recipe/{recipe_id}', function ($recipe_id) {
    $recipe = Recipe::findOrFail($recipe_id);
    return view('chef_lens.challenges.recpie-view', compact('recipe'));
})->name('recipe.view');

Route::get(
    'accpet-challenge/{challenge}',
    function ($id) {
        $challenge = Challenge::findOrFail($id);
        return view('chef_lens.challenges.accpet-challenge', compact('challenge'));
    }
)
    ->name('accpet-challenge');

    Route::get('recipe/{recipe_id}/facts', function ($recipe_id) {
        $recipe = Recipe::findOrFail($recipe_id);
        return view('chef_lens.challenges.facts', compact('recipe'));
    })->name('recipe.facts');

    Route::get('recipe/{recipe_id}/ingredients', function ($recipe_id) {
        $recipe = Recipe::findOrFail($recipe_id);
        return view('chef_lens.challenges.ingredients', compact('recipe'));
    })->name('recipe.ingredients');

    Route::get('recipe/{recipe_id}/steps', function ($recipe_id) {
        $recipe = Recipe::findOrFail($recipe_id);
        $stepsData = $recipe->steps ? $recipe->steps : [];

        return view('chef_lens.challenges.steps', compact('recipe', 'stepsData'));
    })->name('recipe.steps');

Route::middleware('auth.chef')->group(
    function () {


        Route::get('/chef_lens', [VideoController::class, 'index'])->name('chef_lens');
        Route::post('/videos/toggle-like', [VideoController::class, 'toggleLike']);
        Route::post('/videos/toggle-bookmark', [VideoController::class, 'toggleBookmark']);
        Route::post('/videos/update-views', [VideoController::class, 'updateViews']);
        Route::post('/videos/remove', [VideoController::class, 'removeFromSavedOrLiked'])->name('video.remove.saved');

        Route::get('saved_video', function () {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login');
            }
            $savedChallenges = Challenge::whereJsonContains('bookmarked_by', $user->id)
                ->whereNotNull('announcement_path')
                ->get();
            $likedChallenges = Challenge::whereJsonContains('liked_by', $user->id)
                ->whereNotNull('announcement_path')
                ->get();
            $savedSnaps = Snap::whereJsonContains('bookmarked_by', $user->id)
                ->whereNotNull('video_path')
                ->get();
            $likedSnaps = Snap::whereJsonContains('liked_by', $user->id)
                ->whereNotNull('video_path')
                ->get();
            $likedVideos = $likedChallenges->merge($likedSnaps);
            return view('chef_lens.challenges.saved_video', compact('savedChallenges', 'likedChallenges', 'savedSnaps', 'likedSnaps', 'likedVideos'));
        })->name('saved_video');

        Route::delete('/videos/{videoId}/remove', [VideoController::class, 'removeFromSavedOrLiked'])->name('videos.remove');
    }
);
