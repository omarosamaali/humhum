<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChallengeReview;
use App\Models\ChallengeReviewMessage;
use Illuminate\Support\Facades\Auth;

class ChallengeReviewChatController extends Controller
{
    public function show($reviewId)
    {
        $review = ChallengeReview::with([
            'chef.chefProfile',
            'challengeResponse.user', // تأكد من تحميل بيانات المستخدم المتحدي
            'messages.sender'
        ])->findOrFail($reviewId);

        // Debug: تحقق من البيانات (احذف هذا السطر بعد التأكد)
        // dd($review->challengeResponse->user);

        // التحقق من صلاحية الوصول
        $currentUserId = Auth::id();
        $canAccess = ($review->chef_id == $currentUserId) ||
            ($review->challengeResponse->user_id == $currentUserId);

        if (!$canAccess) {
            abort(403, 'غير مصرح لك بالوصول لهذه المحادثة');
        }

        // تحديد الطرف الآخر في المحادثة
        $otherParticipant = null;
        if ($review->chef_id == $currentUserId) {
            // المستخدم الحالي هو الشيف، الطرف الآخر هو المتحدي
            $challengerUser = $review->challengeResponse->user;

            // Debug: اطبع بيانات المتحدي (احذف هذا بعد التأكد)
            // dd($challengerUser->toArray());

            // جرب أسماء أعمدة مختلفة للصورة
            $challengerImage = $review->chef->chefProfile->official_image;

            $otherParticipant = [
                'id' => $review->challengeResponse->user_id,
                'name' => $challengerUser->name,
                'image' => $challengerImage,
                'type' => 'challenger'
            ];
        } else {
            // المستخدم الحالي هو المتحدي، الطرف الآخر هو الشيف
            $otherParticipant = [
                'id' => $review->chef_id,
                'name' => $review->chef->name,
                'image' => $review->chef->chefProfile->official_image ?? 'default-avatar.png',
                'type' => 'chef'
            ];
        }

        // تحديث حالة القراءة للرسائل
        $review->messages()
            ->where('sender_id', '!=', $currentUserId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('challenge-review-chat', compact('review', 'otherParticipant'));
    }

    public function sendMessage(Request $request, $reviewId)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $review = ChallengeReview::with([
            'chef.chefProfile',
            'challengeResponse.user'
        ])->findOrFail($reviewId);

        $currentUserId = Auth::id();

        // التحقق من الصلاحية
        $canAccess = ($review->chef_id == $currentUserId) ||
            ($review->challengeResponse->user_id == $currentUserId);

        if (!$canAccess) {
            return response()->json(['error' => 'غير مصرح'], 403);
        }

        $message = ChallengeReviewMessage::create([
            'challenge_review_id' => $reviewId,
            'sender_id' => $currentUserId,
            'message' => $request->message,
        ]);

        $message->load('sender');

        // تحديد معلومات المرسل
        $senderInfo = [
            'name' => $message->sender->name,
            'image' => null
        ];

        if ($message->sender_id == $review->chef_id) {
            // المرسل هو الشيف
            $senderInfo['image'] = $review->chef->chefProfile->official_image;
        } else {
            // المرسل هو المتحدي - استخدم صورة المتحدي وليس الشيف
            $senderInfo['image'] = $review->chef->chefProfile->official_image;
        }

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'sender_name' => $senderInfo['name'],
                'sender_image' => $senderInfo['image'],
                'sender_id' => $message->sender_id,
                'created_at' => $message->created_at->diffForHumans(),
                'is_current_user' => $message->sender_id == $currentUserId
            ]
        ]);
    }

    public function getMessages($reviewId)
    {
        $review = ChallengeReview::with([
            'chef.chefProfile',
            'challengeResponse.user'
        ])->findOrFail($reviewId);

        $currentUserId = Auth::id();

        $canAccess = ($review->chef_id == $currentUserId) ||
            ($review->challengeResponse->user_id == $currentUserId);

        if (!$canAccess) {
            return response()->json(['error' => 'غير مصرح'], 403);
        }

        $messages = $review->messages()
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) use ($currentUserId, $review) {
                // تحديد صورة المرسل
                $senderImage = 'default-avatar.png';
                if ($message->sender_id == $review->chef_id) {
                    // المرسل هو الشيف
                    $senderImage = $review->chef->chefProfile->official_image ?? $review->chef->chefProfile->official_image;
                } else {
                    // المرسل هو المتحدي - تحقق من عدة أعمدة محتملة للصورة
                    $senderImage = $review->chef->chefProfile->official_image;
                }

                return [
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_name' => $message->sender->name,
                    'sender_image' => $senderImage,
                    'sender_id' => $message->sender_id,
                    'created_at' => $message->created_at->diffForHumans(),
                    'is_current_user' => $message->sender_id == $currentUserId,
                    'is_read' => $message->is_read
                ];
            });

        return response()->json(['messages' => $messages]);
    }
}
