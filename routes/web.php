<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Models\AboutUs;
use App\Models\Terms;
use App\Models\Faq;
use App\Models\MainCategories;
use App\Models\SubCategory;
use App\Models\Recipe;
use App\Models\Kitchens;
use App\Http\Controllers\Admin\RecipesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SnapController;
use App\Http\Controllers\ChallengeReviewChatController;
use App\Models\Snap;
use App\Models\Banner;
use App\Http\Controllers\C1he3f\Auth\ChefAuthenticatedSessionController;
use App\Models\DeliveryLocation;
use App\Models\Challenge;
use App\Models\ChefProfile;
use App\Models\ChallengeReview;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\NotificationController;
use Carbon\Carbon;
use Illuminate\Http\Request;

require __DIR__ . '/auth.php';

Route::post('/save-player-id', [NotificationController::class, 'savePlayerId'])->name('save.player.id');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::patch('/contacts/{id}/read', [ContactController::class, 'markAsRead'])->name('contacts.read');
Route::patch('/contacts/{id}/replied', [ContactController::class, 'markAsReplied'])->name('contacts.replied');
Route::middleware(['auth'])->group(function () {
    Route::post('/delete-account', [ProfileController::class, 'deleteAccount'])->name('account.delete');
    Route::post('/check-email-availability', [ProfileController::class, 'checkEmailAvailability'])->name('email.check');
});
Route::prefix('c1he3f')->middleware(['auth'])->group(function () {
    Route::post('/profile/delivery-location/select/{id}', [ProfileController::class, 'selectDeliveryLocation'])->name('c1he3f.profile.delivery-location.select');
    Route::get('/profile/market-choice', [ProfileController::class, 'showMarketChoice'])->name('c1he3f.profile.market-choice');
    Route::post('/profile/save-market-choice', [ProfileController::class, 'saveMarketChoice'])->name('c1he3f.profile.save-market-choice');
    Route::get('/profile/delivery-locations', [ProfileController::class, 'showDeliveryLocations'])->name('c1he3f.profile.delivery-location');
    Route::get('/profile/add-delivery-address', [ProfileController::class, 'showAddDeliveryAddress'])->name('c1he3f.profile.add-delivery-address');
    Route::post('/profile/store-delivery-address', [ProfileController::class, 'storeDeliveryAddress'])->name('c1he3f.profile.store-delivery-address');
    Route::get('/profile/delivery-location/{id}/edit', [ProfileController::class, 'editDeliveryLocation'])->name('c1he3f.profile.delivery-location.edit');
    Route::put('/profile/delivery-location/{id}', [ProfileController::class, 'updateDeliveryLocation'])->name('c1he3f.profile.delivery-location.update');
    Route::delete('/profile/delivery-location/{id}', [ProfileController::class, 'destroyDeliveryLocation'])->name('c1he3f.profile.delivery-location.destroy');
    Route::get('/coming-soon', [ProfileController::class, 'comingSoon'])->name('c1he3f.coming-soon');
    // Route::get('/', function () {
    //     return view('chef.index');
    // })->name('c1he3f.index');
});

Route::get('/', function () {
    if (!Auth::check()) {
        $chefs = ChefProfile::whereHas('user', function ($query) {
            $query->where('status', 'فعال');
        })->get();
        $kitchens = Kitchens::all();
        return view('welcome', compact('chefs', 'kitchens'));
    }
    $user = Auth::user();
    switch ($user->role) {
        case 'مدير':
            return redirect()->route('admin.dashboard');
        case 'طاه':
            return redirect()->route('c1he3f.index');
        default:
            Auth::logout();
            return redirect()->route('login')->with('error', 'حدث خطأ في تحديد نوع الحساب');
    }
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/get-subcategories', [App\Http\Controllers\Admin\RecipesController::class, 'getSubCategories']);});
Route::post('/c1he3f/snaps/store-snap', [SnapController::class, 'store'])->name('c1he3f.snaps.store-snap');
Route::get('/c1he3f/snaps/get-subcategory-details/{subCategoryId}', [SnapController::class, 'getSubcategoryDetails'])->name('get.subcategory-details');
Route::get('/c1he3f/snaps/get-subcategories/{mainCategoryId}', [SnapController::class, 'getSubcategories'])->name('get.subcategories');
Route::get('/c1he3f/snaps/edit-snap/{snap}', [SnapController::class, 'edit'])->name('c1he3f.snaps.edit-snap');
Route::get('/c1he3f/snaps/lens-show/{snap}', function(Snap $snap){
    return view('c1he3f.snaps.lens-show', compact('snap'));
})->name('c1he3f.snaps.lens-show');

Route::get('/c1he3f/debug-database', [SnapController::class, 'debugDatabase'])
    ->name('c1he3f.debug.database');
Route::get('/c1he3f/subcategories/{mainCategoryId}', [SnapController::class, 'getSubcategories']);
Route::put('/c1he3f/snaps/update-snap/{snap}', [SnapController::class, 'update'])->name('c1he3f.snaps.update-snap');
Route::delete('/c1he3f/snaps/delete/{snap}', [SnapController::class, 'destroy'])->name('c1he3f.snaps.delete');
Route::get('/c1he3f/snaps/all-snap', function () {
    $publishedSnaps = Snap::where('status', 'published')
    ->where('user_id', auth()->user()->id)->with(['mainCategory', 'subCategories'])->get();
    $draftSnaps = Snap::where('status', 'draft')
        ->where('user_id', auth()->user()->id)->with(['mainCategory', 'subCategories'])->get();
    $mainCategories = MainCategories::all();
    $subCategories = SubCategory::all();
    return view('c1he3f.snaps.all-snap', compact('publishedSnaps', 'draftSnaps', 'mainCategories', 'subCategories'));
})->name('c1he3f.snaps.all-snap');
Route::get('/c1he3f/snaps/add-snap', [SnapController::class, 'create'])->name('c1he3f.snaps.add-snap');
Route::get('/c1he3f/coming-soon', function () {
    return view('c1he3f.coming-soon');
})->name('c1he3f.coming-soon');

Route::get('/c1he3f/transactions', function () {
    return view('c1he3f.transactions');
})->name('c1he3f.transactions');

Route::get('/c1he3f/withdrwal', function () {
    return view('c1he3f.withdrwal');
})->name('c1he3f.withdrwal');

Route::get('/c1he3f/about', function () {
    $about = AboutUs::latest()->first();
    return view('/c1he3f/about', compact('about'));
})->name('c1he3f.about');
Route::get('/c1he3f/aboutGuest', function () {
    $about = AboutUs::latest()->first();
    return view('/c1he3f/aboutGuest', compact('about'));
})->name('c1he3f.aboutGuest');
Route::get('/c1he3f/faqGuest', function () {
    $faqs = Faq::whereIn('place', ['chef', 'both'])->get();
    return view('/c1he3f/faqGuest', compact('faqs'));
})->name('c1he3f.faqGuest');
Route::get('/c1he3f/faq', function () {
    $faqs = Faq::whereIn('place', ['chef', 'both'])->get();
    return view('/c1he3f/faq', compact('faqs'));
})->name('c1he3f.faq');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('c1he3f/category/{category}', function ($categoryId) {
    if (!Auth::check()) {
        return redirect()->route('c1he3f.auth.welcome')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
    }
    $chefId = Auth::id();
    $selectedCategory = MainCategories::findOrFail($categoryId);
    $mainCategories = MainCategories::with(['recipes' => function ($query) use ($chefId) {
        $query->where('status', 1)
            ->where('chef_id', $chefId)
            ->with(['kitchen', 'chef', 'subCategories'])
            ->latest();
    }])->withCount(['recipes' => function ($query) use ($chefId) {
        $query->where('status', 1)
            ->where('chef_id', $chefId);
    }])->get();
    return view('c1he3f.category.show', compact('mainCategories', 'selectedCategory'));
})->name('c1he3f.category.show');

Route::get('c1he3f/recipe/{id}', [RecipesController::class, 'showFrontend'])->name('c1he3f.recipe.show');
Route::post('chef/logout', [ChefAuthenticatedSessionController::class, 'destroy'])->name('chef.logout');

Route::get('c1he3f/index', function () {
    if (!Auth::check()) {
        return redirect()->route('c1he3f.auth.welcome')->with('error', 'يجب تسجيل الدخول أولاً.');
    }
    $chef_id = Auth::id();
    $activeChallenge = Challenge::where('chef_id', $chef_id)
        ->where('end_date', '>=', Carbon::now()->toDateString())
        ->whereRaw('CONCAT(end_date, " ", end_time) >= ?', [Carbon::now()])
        ->orderByRaw('CONCAT(end_date, " ", end_time) ASC')
        ->first();

    $banner = Banner::where('display_location', 'mobile_app')
        ->where('status', 1)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->latest()
        ->first();

    $mainCategories = MainCategories::with([
        'recipes' => function ($query) use ($chef_id) {
            $query->where('chef_id', $chef_id);
        }
    ])
        ->withCount(['recipes' => function ($query) use ($chef_id) {
            $query->where('chef_id', $chef_id)->where('status', 1);
        }])
        ->get();

    $recipes = Recipe::with(['kitchen', 'chef', 'mainCategories', 'subCategories'])
        ->where('status', 1)
        ->latest()
        ->get();

    $delivery_locations = DeliveryLocation::where('user_id', Auth::user()->id)->get();
    $notifications = ChallengeReview::where(function ($query) {
        // الشرط الأول: المستخدم هو صاحب التحدي
        $query->whereHas('challengeResponse', function ($q) {
            $q->where('user_id', Auth::id());
        });
    })
        ->orWhere('chef_id', Auth::id()) // الشرط الثاني: المستخدم هو الشيف
        ->with(['chef.chefProfile', 'challengeResponse.user'])
        ->get();

    $notificationsCount = $notifications->count();

    // $notificationsCount = ChallengeReview::whereHas('challengeResponse', function ($query) {
    //     $query->where('user_id', Auth::user()->id);
    // })->count(); 
    
    
    return view('c1he3f.index', compact(
        'recipes',
        'mainCategories',
        'banner',
        'delivery_locations',
        'activeChallenge',
        'notifications',
        'notificationsCount'
    ));
})->name('c1he3f.index');


Route::middleware(['auth'])->group(function () {
    Route::get('/challenge-review-chat/{reviewId}', [ChallengeReviewChatController::class, 'show'])
        ->name('challenge.review.chat');
    Route::post('/challenge-review-chat/{reviewId}/send', [ChallengeReviewChatController::class, 'sendMessage'])
        ->name('challenge.review.chat.send');
    Route::get('/challenge-review-chat/{reviewId}/messages', [ChallengeReviewChatController::class, 'getMessages'])
        ->name('challenge.review.chat.messages');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/challenge-review-chat/{reviewId}', [ChallengeReviewChatController::class, 'show'])
        ->name('challenge.review.chat');
    Route::get('/challenge-review-chat/{reviewId}/messages', [ChallengeReviewChatController::class, 'getMessages'])
        ->name('challenge.review.chat.messages');
});



require __DIR__ . '/auth_chef_lens.php';

require __DIR__ . '/chef_lens.php';

require __DIR__ . '/chef_routes.php';

require __DIR__ . '/admin_routes.php';

require __DIR__ . '/user.php';

require __DIR__ . '/families.php';

require __DIR__ . '/chef.php';