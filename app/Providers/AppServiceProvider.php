<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Challenge;
use App\Models\Snap;
use App\Models\ChallengeResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View Composer للصفحات اللي محتاجة بيانات المستخدم
        View::composer([
            'layouts.chef_lens',
            'chef_lens.profile.index',
            'chef_lens.challenges.index'
        ], function ($view) {
            $user = Auth::user();

            // Check if user is authenticated before proceeding
            if (!$user) {
                // Provide default values for guest users
                $view->with([
                    'savedVideosCount' => 0,
                    'likedVideosCount' => 0,
                    'snapsCcount' => 0,
                    'acceptedChallengesCount' => 0,
                ]);
                return;
            }

            // Count saved Challenges and Snaps
            $savedChallengesCount = Challenge::whereJsonContains('bookmarked_by', $user->id)
                ->whereNotNull('announcement_path')
                ->count();

            $savedSnapsCount = Snap::whereJsonContains('bookmarked_by', $user->id)
                ->whereNotNull('video_path')
                ->count();

            $savedVideosCount = $savedChallengesCount + $savedSnapsCount;

            // Count liked Challenges and Snaps
            $likedChallengesCount = Challenge::whereJsonContains('liked_by', $user->id)
                ->whereNotNull('announcement_path')
                ->count();

            $likedSnapsCount = Snap::whereJsonContains('liked_by', $user->id)
                ->whereNotNull('video_path')
                ->count();

            $likedVideosCount = $likedChallengesCount;

            $snapsCcount = $likedSnapsCount;
            $acceptedChallengesCount = ChallengeResponse::where('user_id', $user->id)->count();

            $view->with([
                'savedVideosCount' => $savedVideosCount,
                'likedVideosCount' => $likedVideosCount,
                'snapsCcount' => $snapsCcount,
                'acceptedChallengesCount' => $acceptedChallengesCount,
            ]);
        });

        // View Composer منفصل لصفحة الـ welcome (للضيوف)
        View::composer('chef_lens.challenges.welcome', function ($view) {
            // بيانات افتراضية للضيوف
            $view->with([
                'savedVideosCount' => 0,
                'likedVideosCount' => 0,
                'snapsCcount' => 0,
                'acceptedChallengesCount' => 0,
            ]);
        });

        Paginator::useTailwind();
    }
}
