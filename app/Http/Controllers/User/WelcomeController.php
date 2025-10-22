<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Kitchens;
use App\Models\Recipe;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::where('display_location', 'mobile_app')
        ->where('status', 1)->where('start_date', '<=', now())
        ->where('end_date', '>=', now())->latest()->first();

        $dailyRecipe = $this->getDailyRecipeForUser();
        $kitchens = Kitchens::where('status', 1)->withCount('recipes')->get();

        $topRecipes = Recipe::withCount('favoritedBy')
            ->orderByDesc('favorited_by_count')
            ->take(3)
            ->get();

        $favorites_count = $dailyRecipe->favoritedBy()->count();
        return view('users.welcome', compact('favorites_count','banner', 'dailyRecipe', 'kitchens', 'topRecipes'));
    }

    private function getDailyRecipeForUser()
    {
        $userId = auth()->id();
        $today = now()->format('Y-m-d'); // تاريخ اليوم

        // نستخدم user_id + التاريخ كـ seed للعشوائية
        $seed = crc32($userId . $today);

        // نجيب عدد الوجبات
        $recipesCount = \App\Models\Recipe::count();

        if ($recipesCount == 0) {
            return null;
        }

        // نحسب index عشوائي بناءً على الـ seed
        $randomIndex = $seed % $recipesCount;

        // نجيب الوجبة
        return \App\Models\Recipe::skip($randomIndex)->first();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
