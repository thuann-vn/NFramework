<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
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

    public function edit(){
        return view('account.edit',
        [
            'user'=> auth()->user()
        ]);
    }

    public function update(Request $request){
        $user = User::find(auth()->user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->saveOrFail();

        return redirect(route('edit-account'))->with('success_message', __('frontend.account.update_successfully'));
    }
}
