<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Auth;
use App\Models\Challenge;
use App\Models\Recipe;
use App\Models\Snap;
use App\Models\Faq;
use App\Http\Controllers\ChallengeController;


Route::get('challenge/profileDisplayed', function () {
    return view('chef_lens.challenges.profileDisplayed');
})
    ->name('chef_lens.profileDisplayed');

Route::get('challenges-own', [ChallengeController::class, 'challengesOwn'])
    ->name('chef_lens.challenge.challenges-own');

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
    return view('chef_lens.profile.index', compact('user'));
})->name('chef_lens.profile');

Route::middleware('auth.chef')->group(
    function () {

        Route::get(
            'accpet-challenge/{challenge}', function ($id) {
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

        Route::get('recipe/{recipe_id}', function ($recipe_id) {
            $recipe = Recipe::findOrFail($recipe_id);
            return view('chef_lens.challenges.recpie-view', compact('recipe'));
        })->name('recipe.view');

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
