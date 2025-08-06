<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\C1he3f\Auth\ChefAuthenticatedSessionController;
use App\Http\Controllers\C1he3f\Auth\ChefPasswordResetLinkController;
use App\Http\Controllers\C1he3f\Auth\ChefNewPasswordController;
use App\Http\Controllers\ChefMarketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\RecipesController;
use App\Models\Kitchens;
use App\Models\MainCategories;
use App\Models\SubCategory;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChallengeController;
use App\Models\Challenge;
use Carbon\Carbon;
use App\Models\ChallengeResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banner;
use App\Models\Recipe;
use App\Models\Hosp;
use App\Models\Food;
use App\Models\Types;
use App\Models\Terms;
// 
use App\Models\ChallengeReview; // Add this import

Route::get('c1he3f/auth/sign-in', function () {
    $kitchens = Kitchens::all();
    foreach ($kitchens as $kitchen) {
        $kitchen->kitchen_count = Recipe::where('kitchen_type_id', $kitchen->id)->count();
    }
    $users = User::where('role', 'طاه')->withCount('recipes')->get();
    foreach ($users as $user) {
        $user->recipes_count = Recipe::where('user_id', $user->id)->count();
    }
    $banner = Banner::where('display_location', 'mobile_app')
        ->where('status', 1)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->latest()
        ->first();
    $hosp = Hosp::first();
    $food = Food::first();
    $types = Types::first();
    return view('c1he3f.auth.sign-in', compact('banner', 'users', 'kitchens', 'hosp', 'food', 'types'));
})->name('c1he3f.auth.sign-in');

Route::get('c1he3f/challenge.order', function () {
    return view('c1he3f.challenge.order');
})->name('challenge.order');

Route::get('c1he3f/challenge.vs', function () {
    $chef_id = Auth::id();
    $now = Carbon::now('Africa/Cairo');

    $chefChallenges = collect();
    $userChallenges = collect();
    $myCookings = collect();

    if (Auth::check()) {
        $chefChallenges = Challenge::with('chef', 'recipe')
            ->withCount('responses') // إضافة عدد الردود
            ->where('challenge_type', 'chefs')
            ->where('chef_id', '!=', $chef_id)
            ->get();

        $userChallenges = Challenge::with('chef', 'recipe')
            ->withCount('responses') // إضافة عدد الردود
            ->where('challenge_type', 'users')
            ->where('chef_id', '!=', $chef_id)
            ->get();

        $myCookings = ChallengeResponse::with('challenge.recipe', 'challenge.chef')
            ->where('user_id', $chef_id)
            ->get();

        // Get IDs of challenges the current user has responded to
        $respondedChallengeIds = ChallengeResponse::where('user_id', $chef_id)
            ->pluck('challenge_id')
            ->toArray();
    } else {
        $respondedChallengeIds = []; // No user logged in, no responses
    }

    $chefChallenges = $chefChallenges->map(function ($challenge) use ($now, $respondedChallengeIds) {
        $start = Carbon::parse($challenge->start_at, 'Africa/Cairo');
        $end = Carbon::parse($challenge->end_at, 'Africa/Cairo');
        $challenge->is_active = $challenge->status === 'active' && $now->between($start, $end);
        $challenge->has_responded = in_array($challenge->id, $respondedChallengeIds);
        return $challenge;
    });

    $userChallenges = $userChallenges->map(function ($challenge) use ($now, $respondedChallengeIds) {
        $start = Carbon::parse($challenge->start_at, 'Africa/Cairo');
        $end = Carbon::parse($challenge->end_at, 'Africa/Cairo');
        $challenge->is_active = $challenge->status === 'active' && $now->between($start, $end);
        $challenge->has_responded = in_array($challenge->id, $respondedChallengeIds);
        return $challenge;
    });

    return view('c1he3f.challenge.vs', compact('chefChallenges', 'userChallenges', 'myCookings'));
})->name('challenge.vs');


Route::get('c1he3f/challenge/review/{challenge_response_id}', function ($challenge_response_id) {
    if (!Auth::check()) {
        return redirect()->route('c1he3f.auth.welcome')->with('error', 'يجب تسجيل الدخول أولاً.');
    }

    $chef_id = Auth::id();
    // dd($chef_id, $challenge_response_id); // أضف هذا السطر مؤقتاً
    try {
        $challengeResponse = ChallengeResponse::with(['challenge', 'user.chefProfile'])
            ->where('id', $challenge_response_id)
            ->whereHas('challenge', function ($query) use ($chef_id) {
                $query->where('chef_id', $chef_id);
            })
            ->firstOrFail();
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // dd('ChallengeResponse not found or not owned by chef', $e->getMessage()); // أضف هذا السطر مؤقتاً
        abort(404); // أو يمكنك إرجاع رسالة خطأ أكثر وضوحًا
    }


    return view('c1he3f.challenge.review', compact('challengeResponse'));
})->name('c1he3f.challenge.review');

Route::post('c1he3f/challenge/review/{challenge_response_id}', function (Request $request, $challenge_response_id) {
    if (!Auth::check()) {
        return response()->json(['success' => false, 'message' => 'يجب تسجيل الدخول أولاً.'], 401);
    }

    $chef_id = Auth::id();

    // Validate that the challenge response exists and belongs to the chef
    $challengeResponse = ChallengeResponse::with('challenge')
        ->where('id', $challenge_response_id)
        ->whereHas('challenge', function ($query) use ($chef_id) {
            $query->where('chef_id', $chef_id);
        })
        ->firstOrFail();

    // Validate the request data
    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'chef_message_response' => 'nullable|string|max:1000',
    ]);

    // Create or update the ChallengeReview
    ChallengeReview::updateOrCreate(
        [
            'challenge_response_id' => $challenge_response_id,
            'chef_id' => $chef_id,
        ],
        [
            'rating' => $validated['rating'],
            'chef_message_response' => $validated['chef_message_response'],
        ]
    );
    $challengeId = $challengeResponse->challenge_id;

    // Redirect with success message

    // جلب الـ ID الخاص بالتحدي من استجابة التحدي
    $challengeId = $challengeResponse->challenge_id;

    // التوجيه إلى صفحة 'vs-show' باستخدام الـ ID الصحيح
    return redirect()->route('challenge.vs-show', ['challenge_id' => $challengeId])
        ->with('success', 'تم تقييم الرد وإرسال رسالتك بنجاح!');})->name('chef.challenge_response.submit_review');


Route::get('c1he3f/challenge/{challenge_id}/vs-show', function ($challenge_id) {
    $challenge = Challenge::with(['challengeResponses.user.chefProfile'])->findOrFail($challenge_id);
    $responses = $challenge->challengeResponses;
    $totalResponses = $responses->count();

    if (Auth::check()) {
        $user = Auth::user();
        // قم بتحميل التقييمات الخاصة بالمستخدم الحالي لكل رد
        $responses->each(function ($response) use ($user) {
            $response->userHasReviewed = $response->reviews()->where('chef_id', $user->id)->exists();
        });
    }

    return view('c1he3f.challenge.vs-show', compact('challenge', 'responses', 'totalResponses'));
})->name('challenge.vs-show');

Route::get('c1he3f/challenge-response/{response_id}/images-vs', [ChallengeController::class, 'showResponseImages'])->name('challenge.image-vs');

Route::get('c1he3f/challenge/{challenge_id}/add-vs', function ($challenge_id) {
    $challenge = Challenge::with('chefProfile')->findOrFail($challenge_id);
    return view('c1he3f.challenge.add-vs', compact('challenge'));
})->name('challenge.add-vs');

Route::post('c1he3f/challenge/{challenge_id}/submit-response', [ChallengeController::class, 'submitResponse'])->name('challenge.submit-response');


Route::get('c1he3f/challenge.vs2', function () {
    $chef_id = Auth::id();

    $userChallengesCount = Challenge::where('chef_id', $chef_id)
        ->where('challenge_type', 'users')
        ->count();

    $chefChallengesCount = Challenge::where('chef_id', $chef_id)
        ->where('challenge_type', 'chefs')
        ->count();

    $challenges = Challenge::where('chef_id', $chef_id)->get();

    // حساب عدد القابلين للتحدي لكل تحدي
    $acceptedChallengesCount = DB::table('challenge_responses')
        ->whereIn('challenge_id', $challenges->pluck('id'))
        ->count();

    // أو إذا كنت تريد عدد القابلين لكل تحدي منفصل
    $challengesWithAcceptedCount = $challenges->map(function ($challenge) {
        $challenge->accepted_count = DB::table('challenge_responses')
            ->where('challenge_id', $challenge->id)
            ->count();
        return $challenge;
    });

    return view('c1he3f.challenge.vs2', compact(
        'challenges',
        'userChallengesCount',
        'chefChallengesCount',
        'acceptedChallengesCount',
        'challengesWithAcceptedCount'
    ));
})->name('challenge.vs2');

Route::get('c1he3f/challenge/create', [ChallengeController::class, 'create'])->name('challenge.create');
Route::post('c1he3f/challenge/store', [ChallengeController::class, 'store'])->name('challenge.store');
Route::get('c1he3f/challenge.all-vs', [ChallengeController::class, 'index'])->name('challenge.all-vs');
Route::get('c1he3f/challenge.all-vs2', [ChallengeController::class, 'index'])->name('challenge.all-vs2');
Route::get('c1he3f/challenge/{id}', [ChallengeController::class, 'show'])->name('challenge.show');
Route::get('c1he3f/challenge/{id}/edit', [ChallengeController::class, 'edit'])->name('challenge.edit');
Route::put('c1he3f/challenge/{id}', [ChallengeController::class, 'update'])->name('challenge.update');



Route::get('/c1he3f/my-products', [ProductController::class, 'index'])->name('c1he3f.my-products');
Route::get('/c1he3f/products/create', [ProductController::class, 'create'])->name('c1he3f.products.create');
Route::post('/c1he3f/products', [ProductController::class, 'store'])->name('c1he3f.products.store');
Route::get('/c1he3f/products/{product}', [ProductController::class, 'show'])->name('c1he3f.products.show');
Route::get('/c1he3f/products/{product}/edit-product', [ProductController::class, 'edit'])->name('c1he3f.products.edit-product');
Route::put('/c1he3f/products/{product}', [ProductController::class, 'update'])->name('c1he3f.products.update');
Route::delete('/c1he3f/products/{product}', [ProductController::class, 'destroy'])->name('c1he3f.products.destroy');

Route::get('/c1he3f/new-message', [MessageController::class, 'create'])->name('c1he3f.new-message');
Route::post('/c1he3f/messages', [MessageController::class, 'store'])->name('c1he3f.messages.store');
Route::get('/c1he3f/messages', [MessageController::class, 'index'])->name('c1he3f.messages');
Route::get('/c1he3f/messages/{id}', [MessageController::class, 'show'])->name('c1he3f.messages.show');
Route::post('/c1he3f/messages/{id}/reply', [MessageController::class, 'reply'])->name('c1he3f.messages.reply');
Route::get('/c1he3f/recpies/{recipe}/edit', [RecipesController::class, 'edit'])->name('c1he3f.recpies.edit');
// Route::put('/c1he3f/recpies/{recipe}/updateChef', [RecipesController::class, 'updateChef'])->name('c1he3f.recpies.updateChef');
Route::put('/c1he3f/recipes/{recipe}', [RecipesController::class, 'updateChef'])->name('c1he3f.recipes.updateChef');

Route::get('/c1he3f/recpies/{recipe}/editChef', [RecipesController::class, 'editChef'])->name('c1he3f.recpies.editChef');
Route::get('/admin/recipes/subcategories', [RecipesController::class, 'getSubCategories'])
    ->name('admin.recipes.subcategories');
Route::put('/c1he3f/recpies/{recipe}/update', [RecipesController::class, 'update'])->name('c1he3f.recpies.update');
Route::get('/c1he3f/recpies/all_recipes', [RecipesController::class, 'allRecipes'])->name('c1he3f.recpies.all_recipes');
Route::get('/chef/recipes/{id}', [RecipesController::class, 'viewRecipe'])->name('chef.recipes.view');
Route::get('/c1he3f/recpies/add-recpie', [RecipesController::class, 'addRecipe'])->name('c1he3f.recpies.add-recpie');
Route::get('/c1he3f/recpies/subcategories', [RecipesController::class, 'getSubCategories'])->name('c1he3f.recpies.subcategories');
// Route::put('/c1he3f/recpies/{id}/update', [RecipesController::class, 'update'])->name('c1he3f.recpies.update');
Route::group(['prefix' => 'c1he3f', 'as' => 'c1he3f.', 'middleware' => ['auth']], function () {
    Route::get('recipes/{recipe}/steps/edit', [RecipesController::class, 'showStepsForm'])->name('recpies.steps');
    Route::put('recipes/{recipe}/steps', [RecipesController::class, 'updateSteps'])->name('recpies.updateSteps');
    Route::get('recipes/{recipe}/ingredients', [RecipesController::class, 'showIngredientsForm'])->name('recpies.ingredients');
    Route::put('recipes/{recipe}/ingredients', [RecipesController::class, 'updateIngredients'])->name('recpies.updateIngredients');
    Route::get('recipes/{recipe}/ingredients/edit', [RecipesController::class, 'showIngredientsForm'])->name('recipes.editIngredients');
    Route::get('recpies/add-recpie', function () {
        $kitchens = Kitchens::select('id', 'name_ar')->get();
        $mainCategories = MainCategories::select('id', 'name_ar')->get();
        $subCategory = SubCategory::select('id', 'name_ar')->get();
        return view('c1he3f/recpies/add-recpie', compact('kitchens', 'mainCategories', 'subCategory'));
    })->name('recpies.add-recpie');
    Route::get('recpies/subcategories', [RecipesController::class, 'getSubCategories'])->name('recpies.subcategories');
    Route::get('recpies/{recipe}/facts', [RecipesController::class, 'showNutritionalFactsForm'])->name('recpies.facts');
    Route::put('recpies/{recipe}/update_nutritional_facts', [RecipesController::class, 'updateNutritionalFacts'])->name('recpies.update_nutritional_facts');
    Route::post('recpies/store', [RecipesController::class, 'storePublicRecipe'])->name('recpies.store');
    Route::get('/recpies/favorites', function () {
        return view('c1he3f.recpies.favorites');
    })->name('recpies.favorites');
    Route::get('recpies/{recipe}', [RecipesController::class, 'showChefRecipes'])->name('recpies.showChefRecipes');
});

// -----------------------------------------------------------------------------
// Chef (C1he3f) Auth Routes - مسارات تسجيل الدخول والتسجيل للطهاة
// -----------------------------------------------------------------------------
Route::middleware('guest')->group(function () {
    // لعرض فورم تسجيل الدخول للطهاة (معدل لاستخدام الدالة الجديدة)
    Route::get('c1he3f/auth/welcome', [ChefAuthenticatedSessionController::class, 'createLogin'])->name('c1he3f.auth.welcome');

    // لمعالجة تسجيل الدخول للطهاة بعد إدخال البيانات (معدل لاستخدام الدالة الجديدة)
    Route::post('c1he3f/auth/welcome', [ChefAuthenticatedSessionController::class, 'storeLogin'])->name('c1he3f.auth.welcome.post');

    // لعرض فورم التسجيل للطاهي (هذه ما زالت تستخدم دالة create الأصلية لـ ChefAuthenticatedSessionController)
    Route::get('c1he3f/auth/sign-up', [ChefAuthenticatedSessionController::class, 'create'])->name('c1he3f.auth.sign-up');

    // لمعالجة تسجيل الطاهي (هذه ما زالت تستخدم دالة store الأصلية لـ ChefAuthenticatedSessionController، التي هي للتسجيل)
    Route::post('c1he3f/auth/sign-up', [ChefAuthenticatedSessionController::class, 'store'])->name('c1he3f.auth.sign-up.post');

    // ... (باقي مسارات الـ OTP واستعادة كلمة المرور كما هي)
    // لعرض فورم تأكيد الـ OTP
    Route::get('c1he3f/auth/otp-confirm', [ChefAuthenticatedSessionController::class, 'showOtpConfirmForm'])->name('c1he3f.auth.otp-confirm');
    // لمعالجة التحقق من الـ OTP
    Route::post('c1he3f/auth/otp-verify', [ChefAuthenticatedSessionController::class, 'verifyOtp'])->name('c1he3f.auth.otp-verify');
    // لإعادة إرسال الـ OTP
    Route::post('c1he3f/auth/otp-resend', [ChefAuthenticatedSessionController::class, 'resendOtp'])->name('c1he3f.auth.otp-resend');

    // مسارات استعادة كلمة المرور للطهاة
    Route::get('c1he3f/auth/forgot-password', [ChefPasswordResetLinkController::class, 'create'])->name('c1he3f.auth.forgot-password.get');
    Route::post('c1he3f/auth/forgot-password', [ChefPasswordResetLinkController::class, 'store'])->name('c1he3f.auth.password.email.chef');
    Route::get('c1he3f/auth/reset-password/{token}', [ChefNewPasswordController::class, 'create'])->name('c1he3f.auth.reset-password.get');
    Route::post('c1he3f/auth/reset-password', [ChefNewPasswordController::class, 'store'])->name('c1he3f.auth.password.update.chef');
});

// -----------------------------------------------------------------------------
// Protected Routes for Authenticated Chefs - مسارات محمية للطهاة بعد تسجيل الدخول
// -----------------------------------------------------------------------------
Route::middleware(['auth'])->prefix('c1he3f/profile')->name('c1he3f.profile.')->group(function () {
    Route::get('/', function () {
        return view('c1he3f/profile/profile');
    })->name('profile');

    Route::get('/my-market', [ChefMarketController::class, 'showMyMarket'])->name('my-market');
    Route::post('/save-market-choice', [ChefMarketController::class, 'saveMyMarketChoice'])->name('save-market-choice');
    Route::get('/delivery-location', [ChefMarketController::class, 'showDeliveryLocations'])->name('delivery-location');
    Route::get('/add-delivery-address', [ChefMarketController::class, 'showAddDeliveryAddressForm'])->name('add-delivery-address');
    Route::post('/store-delivery-address', [ChefMarketController::class, 'storeDeliveryAddress'])->name('store-delivery-address');
    Route::delete('/delivery-location/{deliveryLocation}', [ChefMarketController::class, 'destroyDeliveryLocation'])->name('delivery-location.destroy');
    Route::get('/edit-profile', [ChefMarketController::class, 'edit'])->name('edit-profile');
    Route::post('/update', [ChefMarketController::class, 'update'])->name('update');
    Route::get('/agreement', [ChefMarketController::class, 'showTermsAndConditions'])->name('agreement');
    Route::get('/sign-agreement', [ChefMarketController::class, 'showSignAgreementForm'])->name('sign');
    Route::post('/verify-contract-otp', [ChefMarketController::class, 'verifyContractOtp'])->name('verify-contract-otp');
    Route::post('/resend-contract-otp', [ChefMarketController::class, 'resendContractOtp'])->name('resend-contract-otp');
    Route::get('/transfer', function () {
        $chefProfile = Auth::user()->chefProfile;
        return view('c1he3f/profile/transfer', compact('chefProfile'));
    })->name('transfer');
    Route::post('/updateTransfer', [UserController::class, 'updateTransfer'])->name('updateTransfer');
    Route::get('/agrem', function () {
        $terms = Terms::first();

        return view('c1he3f/profile/agrem', compact('terms'));
    })->name('agrem');
    Route::get('/agryType', function () {
        return view('c1he3f/profile/agryType');
    })->name('agryType');
    Route::post('/update-agreement-type', [UserController::class, 'updateChefAgreementType'])->name('updateAgreementType');
    Route::post('/updateBio', [UserController::class, 'updateChefBio'])->name('updateBio');
    Route::get('/bio', function () {
        return view('c1he3f/profile/bio');
    })->name('bio');
    Route::get('/profileDisplayed', function () {
        return view('c1he3f/profile/profileDisplayed');
    })->name('profileDisplayed');
    Route::post('chef/logout', [ChefAuthenticatedSessionController::class, 'destroy'])->name('chef.logout');
});


Route::get('/chefThree/new-message', [MessageController::class, 'create'])->name('chefThree.new-message');
Route::post('/chefThree/messages', [MessageController::class, 'store'])->name('chefThree.messages.store');
Route::get('/chefThree/messages', [MessageController::class, 'index'])->name('chefThree.messages');
Route::get('/chefThree/messages/{id}', [MessageController::class, 'show'])->name('chefThree.messages.show');
Route::post('/chefThree/messages/{id}/reply', [MessageController::class, 'reply'])->name('chefThree.messages.reply');

Route::get('/chefThree/recpies/all_recipes', [RecipesController::class, 'allRecipes'])->name('chef.recipes.all');
Route::get('/chef/recipes/{id}', [RecipesController::class, 'viewRecipe'])->name('chef.recipes.view');
Route::get('/chefThree/recpies/add-recpie', [RecipesController::class, 'create'])->name('chefThree.recpies.add-recpie');

Route::group(['prefix' => 'chefThree', 'as' => 'chefThree.', 'middleware' => ['auth']], function () {
    Route::get('recipes/{recipe}/steps/edit', [RecipesController::class, 'showStepsForm'])->name('recpies.steps');
    Route::put('recipes/{recipe}/steps', [RecipesController::class, 'updateSteps'])->name('recpies.updateSteps');
    Route::get('recipes/{recipe}/ingredients', [RecipesController::class, 'showIngredientsForm'])->name('recpies.ingredients');
    Route::put('recipes/{recipe}/ingredients', [RecipesController::class, 'updateIngredients'])->name('recpies.updateIngredients');
    Route::get('recipes/{recipe}/ingredients/edit', [RecipesController::class, 'showIngredientsForm'])->name('recipes.editIngredients');
    Route::get('recpies/add-recpie', function () {
        $kitchens = Kitchens::select('id', 'name_ar')->get();
        $mainCategories = MainCategories::select('id', 'name_ar')->get();
        $subCategory = SubCategory::select('id', 'name_ar')->get();
        return view('chefThree/recpies/add-recpie', compact('kitchens', 'mainCategories', 'subCategory'));
    })->name('recpies.add-recpie');
    Route::get('recpies/subcategories', [RecipesController::class, 'getSubCategories'])->name('recpies.subcategories');
    Route::get('recpies/{recipe}/facts', [RecipesController::class, 'showNutritionalFactsForm'])->name('recpies.facts');
    Route::put('recpies/{recipe}/update_nutritional_facts', [RecipesController::class, 'updateNutritionalFacts'])->name('recpies.update_nutritional_facts');
    Route::post('recpies/store', [RecipesController::class, 'storePublicRecipe'])->name('recpies.store');
    Route::get('/recpies/favorites', function () {
        return view('chefThree.recpies.favorites');
    })->name('recpies.favorites');
    Route::get('recpies/{recipe}', [RecipesController::class, 'showChefRecipes'])->name('recpies.showChefRecipes');
});

// -----------------------------------------------------------------------------
// Chef (chefThree) Auth Routes - مسارات تسجيل الدخول والتسجيل للطهاة
// -----------------------------------------------------------------------------
Route::middleware('guest')->group(function () {
    // لعرض فورم تسجيل الدخول للطهاة (معدل لاستخدام الدالة الجديدة)
    Route::get('chefThree/auth/welcome', [ChefAuthenticatedSessionController::class, 'createLogin'])->name('chefThree.auth.welcome');

    // لمعالجة تسجيل الدخول للطهاة بعد إدخال البيانات (معدل لاستخدام الدالة الجديدة)
    Route::post('chefThree/auth/welcome', [ChefAuthenticatedSessionController::class, 'storeLogin'])->name('chefThree.auth.welcome.post');

    // لعرض فورم التسجيل للطاهي (هذه ما زالت تستخدم دالة create الأصلية لـ ChefAuthenticatedSessionController)
    Route::get('chefThree/auth/sign-up', [ChefAuthenticatedSessionController::class, 'create'])->name('chefThree.auth.sign-up');

    // لمعالجة تسجيل الطاهي (هذه ما زالت تستخدم دالة store الأصلية لـ ChefAuthenticatedSessionController، التي هي للتسجيل)
    Route::post('chefThree/auth/sign-up', [ChefAuthenticatedSessionController::class, 'store'])->name('chefThree.auth.sign-up.post');

    // ... (باقي مسارات الـ OTP واستعادة كلمة المرور كما هي)
    // لعرض فورم تأكيد الـ OTP
    Route::get('chefThree/auth/otp-confirm', [ChefAuthenticatedSessionController::class, 'showOtpConfirmForm'])->name('chefThree.auth.otp-confirm');
    // لمعالجة التحقق من الـ OTP
    Route::post('chefThree/auth/otp-verify', [ChefAuthenticatedSessionController::class, 'verifyOtp'])->name('chefThree.auth.otp-verify');
    // لإعادة إرسال الـ OTP
    Route::post('chefThree/auth/otp-resend', [ChefAuthenticatedSessionController::class, 'resendOtp'])->name('chefThree.auth.otp-resend');

    // مسارات استعادة كلمة المرور للطهاة
    Route::get('chefThree/auth/forgot-password', [ChefPasswordResetLinkController::class, 'create'])->name('chefThree.auth.forgot-password.get');
    Route::post('chefThree/auth/forgot-password', [ChefPasswordResetLinkController::class, 'store'])->name('chefThree.auth.password.email.chef');
    Route::get('chefThree/auth/reset-password/{token}', [ChefNewPasswordController::class, 'create'])->name('chefThree.auth.reset-password.get');
    Route::post('chefThree/auth/reset-password', [ChefNewPasswordController::class, 'store'])->name('chefThree.auth.password.update.chef');
});

// -----------------------------------------------------------------------------
// Protected Routes for Authenticated Chefs - مسارات محمية للطهاة بعد تسجيل الدخول
// -----------------------------------------------------------------------------
Route::middleware(['auth'])->prefix('chefThree/profile')->name('chefThree.profile.')->group(function () {
    Route::get('/', function () {
        return view('chefThree/profile/profile');
    })->name('profile');

    Route::get('/my-market', [ChefMarketController::class, 'showMyMarket'])->name('my-market');
    Route::post('/save-market-choice', [ChefMarketController::class, 'saveMyMarketChoice'])->name('save-market-choice');
    Route::get('/delivery-location', [ChefMarketController::class, 'showDeliveryLocations'])->name('delivery-location');
    Route::get('/add-delivery-address', [ChefMarketController::class, 'showAddDeliveryAddressForm'])->name('add-delivery-address');
    Route::post('/store-delivery-address', [ChefMarketController::class, 'storeDeliveryAddress'])->name('store-delivery-address');
    Route::delete('/delivery-location/{deliveryLocation}', [ChefMarketController::class, 'destroyDeliveryLocation'])->name('delivery-location.destroy');
    Route::get('/edit-profile', [ChefMarketController::class, 'edit'])->name('edit-profile');
    Route::post('/update', [ChefMarketController::class, 'update'])->name('update');
    Route::get('/agreement', [ChefMarketController::class, 'showTermsAndConditions'])->name('agreement');
    Route::get('/sign-agreement', [ChefMarketController::class, 'showSignAgreementForm'])->name('sign');
    Route::post('/verify-contract-otp', [ChefMarketController::class, 'verifyContractOtp'])->name('verify-contract-otp');
    Route::post('/resend-contract-otp', [ChefMarketController::class, 'resendContractOtp'])->name('resend-contract-otp');
    Route::get('/transfer', function () {
        $chefProfile = Auth::user()->chefProfile;
        return view('chefThree/profile/transfer', compact('chefProfile'));
    })->name('transfer');
    Route::post('/updateTransfer', [UserController::class, 'updateTransfer'])->name('updateTransfer');
    Route::get('/agrem', function () {
        $terms = Terms::first();
        return view('chefThree/profile/agrem', compact('terms'));
    })->name('agrem');
    Route::get('/agryType', function () {
        return view('chefThree/profile/agryType');
    })->name('agryType');
    Route::post('/update-agreement-type', [UserController::class, 'updateChefAgreementType'])->name('updateAgreementType');
    Route::post('/updateBio', [UserController::class, 'updateChefBio'])->name('updateBio');
    Route::get('/bio', function () {
        return view('chefThree/profile/bio');
    })->name('bio');
    Route::get('/profileDisplayed', function () {
        return view('chefThree/profile/profileDisplayed');
    })->name('profileDisplayed');
    Route::post('chef/logout', [ChefAuthenticatedSessionController::class, 'destroy'])->name('chef.logout');
});
