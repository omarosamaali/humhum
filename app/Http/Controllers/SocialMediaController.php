<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialMediaController extends Controller
{
    /**
     * Display the social media form
     */
    public function index()
    {
        $socialMedia = SocialMedia::where('user_id', auth()->id())->first();
        return view('/c1he3f/profile/social-media', compact('socialMedia'));
    }

    /**
     * Store or update social media links
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'youtube' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'snapchat' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
        ], [
            'youtube.url' => 'رابط YouTube غير صحيح',
            'tiktok.url' => 'رابط TikTok غير صحيح',
            'instagram.url' => 'رابط Instagram غير صحيح',
            'snapchat.url' => 'رابط Snapchat غير صحيح',
            'facebook.url' => 'رابط Facebook غير صحيح',
            '*.max' => 'الرابط طويل جداً',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Check if record exists for current user
            $socialMedia = SocialMedia::where('user_id', auth()->id())->first();

            if ($socialMedia) {
                // Update existing record
                $socialMedia->update([
                    'youtube' => $request->youtube,
                    'tiktok' => $request->tiktok,
                    'instagram' => $request->instagram,
                    'snapchat' => $request->snapchat,
                    'facebook' => $request->facebook,
                    'is_active' => true
                ]);
            } else {
                // Create new record for current user
                SocialMedia::create([
                    'user_id' => auth()->id(),
                    'youtube' => $request->youtube,
                    'tiktok' => $request->tiktok,
                    'instagram' => $request->instagram,
                    'snapchat' => $request->snapchat,
                    'facebook' => $request->facebook,
                    'is_active' => true
                ]);
            }

            return redirect()->back()->with('success', 'تم حفظ روابط التواصل الاجتماعي بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء حفظ البيانات');
        }
    }

    /**
     * Get social media links for API
     */
    public function getSocialMediaLinks(Request $request)
    {
        // يمكن تمرير user_id في الطلب أو استخدام المستخدم الحالي
        $userId = $request->get('user_id', auth()->id());

        $socialMedia = SocialMedia::getUserLinks($userId);

        if (!$socialMedia) {
            return response()->json([
                'success' => false,
                'message' => 'لا توجد روابط تواصل اجتماعي'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $socialMedia->getLinksArray()
        ]);
    }

    /**
     * Toggle social media status
     */
    public function toggleStatus()
    {
        $socialMedia = SocialMedia::where('user_id', auth()->id())->first();

        if ($socialMedia) {
            $socialMedia->update([
                'is_active' => !$socialMedia->is_active
            ]);

            $status = $socialMedia->is_active ? 'تم تفعيل' : 'تم إلغاء تفعيل';
            return redirect()->back()->with('success', $status . ' روابط التواصل الاجتماعي');
        }

        return redirect()->back()->with('error', 'لا توجد بيانات للتعديل');
    }
}
