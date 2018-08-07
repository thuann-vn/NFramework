<?php

namespace App\Http\Controllers;

use TCG\Voyager\Models\Page;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.basic');
    }

    public function index()
    {
        return view('account.index',
        [
            'user'=> auth()->user()
        ]);
    }
}
