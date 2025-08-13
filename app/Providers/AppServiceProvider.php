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
        View::composer('layouts.chef_lens', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();

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

                $likedVideosCount = $likedChallengesCount + $likedSnapsCount;

                $acceptedChallengesCount = ChallengeResponse::where('user_id', Auth::user()->id)->count();

                $view->with([
                    'savedVideosCount' => $savedVideosCount,
                    'likedVideosCount' => $likedVideosCount,
                    'acceptedChallengesCount' => $acceptedChallengesCount,
                ]);
            } else {
                $view->with([
                    'savedVideosCount' => 0,
                    'likedVideosCount' => 0,
                    'acceptedChallengesCount' => 0
                ]);
            }
        });

        Paginator::useTailwind();
    }
}
