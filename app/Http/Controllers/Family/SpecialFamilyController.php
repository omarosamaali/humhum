<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Models\SpecialRequest;
use App\Models\Cook;
use App\Models\MyFamily;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SpecialRequestAttendee;

class SpecialFamilyController extends Controller
{
    public function index()
    {
        $specialRequests = SpecialRequest::with(['cook', 'recipe', 'familyMember'])
            ->where('user_id', session('family_id'))
            ->orWhere('family_member_id', session('family_id'))
            ->orWhere('family_user_id', session('family_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // $specialRequests = SpecialRequest::with(['cook', 'recipe', 'familyMember'])
        //     ->where('user_id', session('family_id'))
        //     ->orWhere('family_member_id', session('family_id'))
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(10);

        return view('families.special.index', compact('specialRequests'));
    }

    public function create()
    {
        $familyId = session('family_id');
        $cooks = Cook::all();
        $familyMember = MyFamily::find($familyId);
        $family_members = $familyMember
            ? MyFamily::where('user_id', $familyMember->user_id)->get()
            : collect();
        $meals = Recipe::take(10)->get();
        return view('families.special.create', compact('cooks', 'family_members', 'meals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cooking_by' => 'required|in:family,cook',
            'cook_id' => 'required|numeric',
            'recipe_id' => 'required|exists:recipes,id',
            'meal_type' => 'required|in:breakfast,lunch,dinner',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'attendees' => 'nullable|array',
            'attendees.*' => 'numeric',
            'guests_count' => 'nullable|integer|min:0',
        ]);

        DB::transaction(function () use ($request, &$special) {
            $cookData = [];
            if ($request->cooking_by === 'cook') {
                $cookData['cook_id'] = $request->cook_id;
                $cookData['family_member_id'] = null;
            } else {
                $cookData['cook_id'] = null;
                $cookData['family_member_id'] = $request->cook_id;
            }

            // هنا نحدد أي user_id أو family_user_id
            $familyUserId = session('family_id') ?? null; // إذا موجود في السيشن
            $userId = auth()->check() ? auth()->id() : null;

            $special = SpecialRequest::create([
                'user_id' => $userId,                      // ممكن يكون null
                'family_user_id' => $familyUserId,         // ممكن يكون null
                'cook_id' => $cookData['cook_id'],
                'family_member_id' => $cookData['family_member_id'],
                'recipe_id' => $request->recipe_id,
                'meal_type' => $request->meal_type,
                'date' => $request->date,
                'time' => $request->time,
                'guests_count' => $request->guests_count ?? 0,
            ]);

            if ($request->has('attendees') && is_array($request->attendees)) {
                $attendees = [];
                foreach ($request->attendees as $attendeeId) {
                    $type = ($attendeeId == session('family_id')) ? 'user' : 'family_member';
                    $attendees[] = [
                        'special_request_id' => $special->id,
                        'attendee_id' => $attendeeId,
                        'attendee_type' => $type,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                SpecialRequestAttendee::insert($attendees);
            }
        });

        return redirect()->route('families.welcome', $special->id ?? 1)
            ->with('success', 'تم إرسال الطلب بنجاح!');
    }


    public function show($id)
    {
        $specialRequest = SpecialRequest::with(['user', 'cook', 'recipe'])
            ->where('user_id', session('family_id'))
            ->findOrFail($id);
        return view('families.welcome', compact('specialRequest'));
    }

    public function destroy($id)
    {
        $specialRequest = SpecialRequest::where('user_id', session('family_id'))->findOrFail($id);
        $specialRequest->delete();
        return redirect()->route('families.special.index')
            ->with('success', 'تم إلغاء الطلب بنجاح');
    }

    public function loadMoreMeals(Request $request)
    {
        $skip = $request->get('skip', 0);
        $meals = Recipe::skip($skip)->take(10)->get();
        return response()->json([
            'meals' => $meals,
            'hasMore' => $meals->count() === 10
        ]);
    }
}
