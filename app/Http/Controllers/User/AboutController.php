<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $about = AboutUs::first();
        return view('users.about.index', compact('about'));
    }

    public function chefIndex()
    {
        $about = AboutUs::first();
        return view('users.about.chef-index', compact('about'));
    }
}
