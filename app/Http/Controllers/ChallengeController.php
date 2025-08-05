<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Recipe;
use Illuminate\Support\Str;
use App\Rules\NoMoreThanOneActiveChallenge;
use App\Models\ChallengeResponse;
use App\Models\User;
use App\Models\ChefProfile;

class ChallengeController extends Controller
{
    public function showResponseImages($response_id)
    {
        $response = ChallengeResponse::with('user.chefProfile')->findOrFail($response_id);

        return view('c1he3f.challenge.image-vs', compact('response'));
    }


    public function showChallengeResponses($challenge_id)
    {
        // 1. جلب التحدي نفسه للتأكد من وجوده وللحصول على تفاصيله لو احتجناها
        $challenge = Challenge::findOrFail($challenge_id);

        // 2. جلب جميع ردود التحدي لهذا التحدي المحدد
        // وهنحمل العلاقات عشان نجيب بيانات المستخدم (صاحب الرد) وملف تعريف الشيف الخاص بيه
        $responses = ChallengeResponse::where('challenge_id', $challenge_id)
            ->with(['user.chefProfile']) // user هو صاحب الرد، و chefProfile هو ملف الشيف بتاعه
            ->get();

        // 3. لو مفيش ردود، ممكن تعمل redirect أو تعرض رسالة
        if ($responses->isEmpty()) {
            return redirect()->back()->with('info', 'لا توجد ردود على هذا التحدي بعد.');
        }

        return view('c1he3f.challenge.vs-show', compact('challenge', 'responses'));
    }

    public function showAcceptChallengeForm($challenge_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول لقبول التحديات.');
        }
                $challenge = Challenge::with(['chef_profiles', 'recipe'])->findOrFail($challenge_id);

        if (Auth::id() === $challenge->chef_id) {
            return back()->with('error', 'لا يمكنك قبول التحدي الخاص بك.');
        }

        return view('c1he3f.challenge.add-vs', compact('challenge'));
    }

    public function submitResponse(Request $request, $challenge_id)
    {
        // 1. التحقق من صلاحية المستخدم والتحدي
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول لقبول التحديات.');
        }

        $challenge = Challenge::findOrFail($challenge_id);

        // يمكنك إضافة منطق للتحقق مما إذا كان المستخدم قد قبل هذا التحدي من قبل
        // أو إذا كان التحدي لا يزال نشطًا.
        if (Auth::id() === $challenge->chef_id) {
            return back()->with('error', 'لا يمكنك قبول التحدي الخاص بك.');
        }

        // 2. التحقق من صحة البيانات المرسلة
        $request->validate([
            'recipe_image' => 'nullable|image|max:5120', // 5MB
            'challenge_video' => 'required|file|mimes:mp4,mov,avi|max:307200', // 300MB (3 دقائق تقريبًا)
            'message_to_chef' => 'nullable|string|max:500',
        ]);

        // 3. معالجة رفع الملفات
        $recipeImagePath = null;
        if ($request->hasFile('recipe_image')) {
            $recipeImagePath = $request->file('recipe_image')->store('challenge_responses/images', 'public');
        }

        $challengeVideoPath = null;
        if ($request->hasFile('challenge_video')) {
            $challengeVideoPath = $request->file('challenge_video')->store('challenge_responses/videos', 'public');
        }

        // 4. حفظ بيانات الاستجابة في قاعدة البيانات
        // ستحتاج إلى موديل وجدول جديد لـ ChallengeResponse
        // يحتوي على challenge_id, user_id (المستخدم الذي قبل التحدي),
        // recipe_image_path, challenge_video_path, message_to_chef, status, created_at, updated_at
        ChallengeResponse::create([
            'challenge_id' => $challenge->id,
            'user_id' => Auth::id(), // المستخدم الذي قبل التحدي
            'recipe_image_path' => $recipeImagePath,
            'challenge_video_path' => $challengeVideoPath,
            'message_to_chef' => $request->input('message_to_chef'),
            'status' => 'pending', // أو أي حالة أولية (مثال: waiting_for_review)
        ]);

        return redirect()->route('challenge.vs')->with('success', 'تم إرسال استجابتك للتحدي بنجاح!');
    }

    public function index()
    {
        $now = Carbon::now('Africa/Cairo');
        $challenges = Challenge::with('chef', 'recipe')->get();
        $challenges = $challenges->map(function ($challenge) use ($now) {
            $start = Carbon::parse($challenge->start_date . ' ' . $challenge->start_time, 'Africa/Cairo');
            $end = Carbon::parse($challenge->end_date . ' ' . $challenge->end_time, 'Africa/Cairo');
            $challenge->is_active = $challenge->status === 'active' && $now->between($start, $end);
            return $challenge;
        });
        return view('c1he3f.challenge.all-vs', compact('challenges'));
    }

    public function create()
    {
        $chefId = Auth::id();
        $recipes = Recipe::where('user_id', $chefId)->get();
        return view('c1he3f.challenge.create', compact('recipes'));
    }

    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        $request->validate([
            'file' => 'required|file|max:50000|mimes:jpeg,png,jpg,gif,svg,mp4,mov,ogg,qt', // max 50MB (50000 KB)
            'name' => 'required|string|max:255',
            'bsMaterialDatePicker' => 'required|date_format:Y-m-d',
            'bsMaterialTimePicker' => 'required|date_format:H:i',
            'bsMaterialDatePicker1' => 'required|date_format:Y-m-d|after_or_equal:bsMaterialDatePicker',
            'bsMaterialTimePicker1' => 'required|date_format:H:i', // You might need more complex validation here to ensure end time is after start time
            'recipe_id' => 'nullable|exists:recipes,id',
            'price' => 'nullable|numeric|min:0.01', // Add validation if recipe_id is present
            'filterRadio' => 'required|in:users,chefs',
            'status' => ['required', 'in:active,inactive', new NoMoreThanOneActiveChallenge()],
        ]);

        // Combine date and time for start and end
        $start_datetime = $request->input('bsMaterialDatePicker') . ' ' . $request->input('bsMaterialTimePicker');
        $end_datetime = $request->input('bsMaterialDatePicker1') . ' ' . $request->input('bsMaterialTimePicker1');

        // Check if the end date/time is after the start date/time
        if (strtotime($end_datetime) <= strtotime($start_datetime)) {
            return back()->withErrors(['date_time' => 'تاريخ ووقت الانتهاء يجب أن يكون بعد تاريخ ووقت البدء.'])->withInput();
        }

        // 2. Implement the active challenge check
        if ($request->input('status') == 'active') {
            $existingActiveChallenge = Challenge::where('chef_id', Auth::id())
                ->where('status', 'active')
                ->first();

            if ($existingActiveChallenge) {
                return back()->with('error', 'لا يمكنك إضافة أكثر من تحدي فعال واحد في نفس الوقت.')->withInput();
            }
        }

        // 3. Handle file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('challenges', $fileName, 'public'); // Store in storage/app/public/challenges
        }

        // 4. Create the new challenge
        $challenge = new Challenge();
        // $challenge->message = $validated['name'];
        // $challenge->start_date = $validated['bsMaterialDatePicker'];
        // $challenge->start_time = $validated['bsMaterialTimePicker'];
        // $challenge->end_date = $validated['bsMaterialDatePicker1'];
        // $challenge->end_time = $validated['bsMaterialTimePicker1'];
        // $challenge->recipe_id = $validated['recipe_id']; // Update the recipe_id
        // $challenge->price = $validated['price'] ?? null;
        // $challenge->challenge_type = $validated['filterRadio'];
        // $challenge->status = $validated['status']; // Directly use 'status' from validation
        #
        $challenge->user_id = Auth::id();
        $challenge->chef_id = Auth::id(); // Assign the authenticated chef's ID
        $challenge->announcement_path = $filePath;
        $challenge->message = $request->input('name');
        $challenge->start_date = $request->input('bsMaterialDatePicker');
        $challenge->start_time = $request->input('bsMaterialTimePicker');
        $challenge->end_date = $request->input('bsMaterialDatePicker1');
        $challenge->end_time = $request->input('bsMaterialTimePicker1');
        $challenge->recipe_id = $request->input('recipe_id');
        $challenge->price = $request->input('price');
        $challenge->challenge_type = $request->input('filterRadio'); // 'users' or 'chefs'
        $challenge->status = $request->input('status');
        $challenge->save();

        return redirect('c1he3f/challenge.all-vs')->with('success', 'تم إنشاء التحدي بنجاح!');
    }

    public function show($id)
    {
        $challenge = Challenge::with('chefProfile', 'recipe')->findOrFail($id);
        return view('c1he3f.challenge.show', compact('challenge'));
    }

    public function edit($id)
    {
        $challenge = Challenge::findOrFail($id);
        $chefId = Auth::id();
        $recipes = Recipe::where('user_id', $chefId)->get();
        return view('c1he3f.challenge.edit', compact('challenge', 'recipes'));
    }

    public function update(Request $request, $id)
    {
        try {
            $challenge = Challenge::findOrFail($id);

            \Log::info('Challenge update request data for ID ' . $id . ':', $request->all());

            $validated = $request->validate([
                'file' => 'nullable|file|mimes:mp4,mov,avi,jpg,jpeg,png|max:51200',
                'message' => 'required|string|max:500', // Changed 'name' to 'message'
                'start_date' => 'required|date', // Changed 'bsMaterialDatePicker' to 'start_date'
                'start_time' => 'required|string', // Changed 'bsMaterialTimePicker' to 'start_time'
                'end_date' => 'required|date|after_or_equal:start_date', // Changed 'bsMaterialDatePicker1' to 'end_date'
                'end_time' => 'required|string', // Changed 'bsMaterialTimePicker1' to 'end_time'
                'recipe_id' => 'required|exists:recipes,id', // Matches 'name' in Blade
                'price' => 'nullable|numeric|min:0',
                'challenge_type' => 'required|in:users,chefs', // Changed 'filterRadio' to 'challenge_type'
                'status' => ['required', 'in:active,inactive', new NoMoreThanOneActiveChallenge()],
            ]);

            if ($request->hasFile('file')) {
                if ($challenge->announcement_path) {
                    Storage::disk('public')->delete($challenge->announcement_path);
                }
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('challenges', $filename, 'public');
                $challenge->announcement_path = $filePath;
                \Log::info('New file uploaded successfully for update:', ['path' => $filePath]);
            }

            $challenge->message = $validated['message'];
            $challenge->start_date = $validated['start_date'];
            $challenge->start_time = $validated['start_time'];
            $challenge->end_date = $validated['end_date'];
            $challenge->end_time = $validated['end_time'];
            $challenge->recipe_id = $validated['recipe_id'];
            $challenge->price = $validated['price'] ?? null;
            $challenge->challenge_type = $validated['challenge_type'];
            $challenge->status = $validated['status'];

            $challenge->save();

            \Log::info('Challenge updated successfully:', ['id' => $challenge->id]);

            return redirect()->route('challenge.all-vs')->with('success', 'تم تحديث التحدي بنجاح!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error during challenge update:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Error updating challenge:', ['error' => $e->getMessage()]);
            return back()->with('error', 'حدث خطأ أثناء تحديث التحدي. يرجى المحاولة مرة أخرى.')->withInput();
        }
    }

    public function destroy($id)
    {
        $challenge = Challenge::findOrFail($id);
        if ($challenge->announcement_path) {
            Storage::disk('public')->delete($challenge->announcement_path);
        }
        $challenge->delete();
        return redirect()->route('challenge.all-vs')->with('success', 'تم حذف التحدي بنجاح!');
    }
}
