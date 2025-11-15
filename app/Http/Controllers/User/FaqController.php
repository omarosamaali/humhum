<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $faqs = Faq::where('status', 1)->where('place', 'both')->orWhere('place', 'user')
        ->get();
        return view('users.faq.index', compact('faqs'));
    }
}
