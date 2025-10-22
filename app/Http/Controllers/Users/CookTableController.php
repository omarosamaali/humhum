<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CookTableController extends Controller
{
    public function index(Request $request)
    {
        return view('users.cook_table.index');
    }
}
