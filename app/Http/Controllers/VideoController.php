<?php

namespace App\Http\Controllers;

use App\Models\ChefProfile;
use App\Models\Challenge;
use App\Models\Snap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChallengeReview;

class VideoController extends Controller
{
    /**
     * عرض صفحة الشيف لانس مع التحديات والسنابات
     */
    public function index()
    {
        $notifications = ChallengeReview::where(function ($query) {
            // الشرط الأول: المستخدم هو صاحب التحدي
            $query->whereHas('challengeResponse', function ($q) {
                $q->where('user_id', Auth::id());
            });
        })
            ->orWhere('chef_id', Auth::id()) // الشرط الثاني: المستخدم هو الشيف
            ->with(['chef.chefProfile', 'challengeResponse.user'])
            ->get();

        $notificationsCount = $notifications->count();        $challenges = Challenge::whereNotNull('announcement_path')->get();
        $snaps = Snap::whereNotNull('video_path')->get();

        $chefs = ChefProfile::whereHas('user.challenges', function ($query) {
            $query->whereNotNull('announcement_path');
        })->orWhereHas('user.snaps', function ($query) {
            $query->whereNotNull('video_path');
        })->get();

        return view('chef_lens.challenges.index', compact('challenges', 'snaps', 'chefs', 'notifications'
        , 'notificationsCount'
    ));
    }
    public function removeFromSavedOrLiked(Request $request, $videoId)
    {
        try {
            $type = $request->input('type');
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'يجب تسجيل الدخول'], 401);
            }

            if ($type === 'challenge') {
                $video = Challenge::findOrFail($videoId);
            } elseif ($type === 'snap') {
                $video = Snap::findOrFail($videoId);
            } else {
                return response()->json(['error' => 'نوع الفيديو غير صالح'], 400);
            }

            // Determine field based on list context
            $field = $request->input('list') === 'saved' ? 'bookmarked_by' : 'liked_by';
            $array = $video->$field ?? [];

            if (in_array($user->id, $array)) {
                $video->$field = array_values(array_diff($array, [$user->id]));
                if ($field === 'liked_by') {
                    $video->decrement('likes');
                } elseif ($field === 'bookmarked_by') {
                    $video->decrement('bookmarks');
                }
                $video->save();

                return response()->json([
                    'success' => true,
                    'message' => 'تم حذف الفيديو بنجاح'
                ]);
            }

            return response()->json(['error' => 'الفيديو غير موجود في القائمة'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'فشل في الحذف',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * تحديث عداد المشاهدات لفيديو (سواء كان Challenge أو Snap)
     */
    public function updateViews(Request $request)
    {
        try {
            $type = $request->input('type');
            $videoId = $request->input('videoId');

            if ($type === 'challenge') {
                $video = Challenge::findOrFail($videoId);
            } elseif ($type === 'snap') {
                $video = Snap::findOrFail($videoId);
            } else {
                return response()->json(['error' => 'نوع الفيديو غير صالح'], 400);
            }

            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'يجب تسجيل الدخول'], 401);
            }

            $viewedBy = $video->viewed_by ?? [];
            if (!in_array($user->id, $viewedBy)) {
                $viewedBy[] = $user->id;
                $video->viewed_by = $viewedBy;
                $video->increment('views');
                $video->save();
            }

            return response()->json([
                'success' => true,
                'views' => $video->views
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'فشل في تحديث المشاهدات',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * تبديل حالة الإعجاب لفيديو (سواء كان Challenge أو Snap)
     */
    public function toggleLike(Request $request)
    {
        try {
            $type = $request->input('type');
            $videoId = $request->input('videoId');

            if ($type === 'challenge') {
                $video = Challenge::findOrFail($videoId);
            } elseif ($type === 'snap') {
                $video = Snap::findOrFail($videoId);
            } else {
                return response()->json(['error' => 'نوع الفيديو غير صالح'], 400);
            }

            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'يجب تسجيل الدخول'], 401);
            }

            $likedBy = $video->liked_by ?? [];
            $isLiked = in_array($user->id, $likedBy);

            if ($isLiked) {
                $likedBy = array_diff($likedBy, [$user->id]);
                $video->decrement('likes');
            } else {
                $likedBy[] = $user->id;
                $video->increment('likes');
            }

            $video->liked_by = array_values($likedBy);
            $video->save();

            return response()->json([
                'success' => true,
                'likes' => $video->likes,
                'is_liked' => !$isLiked
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'فشل في تحديث الإعجابات',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * تبديل حالة المفضلة لفيديو (سواء كان Challenge أو Snap)
     */
    public function toggleBookmark(Request $request)
    {
        try {
            $type = $request->input('type');
            $videoId = $request->input('videoId');

            if ($type === 'challenge') {
                $video = Challenge::findOrFail($videoId);
            } elseif ($type === 'snap') {
                $video = Snap::findOrFail($videoId);
            } else {
                return response()->json(['error' => 'نوع الفيديو غير صالح'], 400);
            }

            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'يجب تسجيل الدخول'], 401);
            }

            $bookmarkedBy = $video->bookmarked_by ?? [];
            $isBookmarked = in_array($user->id, $bookmarkedBy);

            if ($isBookmarked) {
                $bookmarkedBy = array_diff($bookmarkedBy, [$user->id]);
                $video->decrement('bookmarks');
            } else {
                $bookmarkedBy[] = $user->id;
                $video->increment('bookmarks');
            }

            $video->bookmarked_by = array_values($bookmarkedBy);
            $video->save();

            return response()->json([
                'success' => true,
                'bookmarks' => $video->bookmarks,
                'is_bookmarked' => !$isBookmarked
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'فشل في تحديث المفضلة',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
