<?php

namespace App\Http\Controllers;

use App\User;
use App\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->saveOrFail();

        return redirect(route('edit-account'))->with('success_message', __('frontend.account.update_successfully'));
    }

    public function addressBook(){
        return view('account.address',
            [
                'user'=> auth()->user()
            ]);
    }

    public function addressBookAdd(){
        return view('account.add-address');
    }

    public function addressBookStore(Request $request){
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
        ]);

        $address = $request->only(['name', 'phone','email','address','city', 'province']);
        $address['user_id'] = auth()->user()->id;
        UserAddress::create($address);

        return redirect(route('my-address-book'))->with('success_message', __('frontend.address.update_address_successfully'));
    }

    public function addressBookUpdate($id){
        $address = UserAddress::find($id);
        if(empty($address) || $address->user_id != auth()->user()->id){
            return redirect(route('my-address-book'))->with('error_message', __('frontend.address.address_not_existed'));
        }
        return view('account.update-address', ['address' => $address]);
    }

    public function updateAddress(Request $request){
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
        ]);

        $address = UserAddress::find($request->input('id'));

        if(empty($address) || $address->user_id != auth()->user()->id){
            return redirect(route('my-address-book'))->with('error_message', __('frontend.address.address_not_existed'));
        }
        $address->name = $request->input('name');
        $address->phone = $request->input('phone');
        $address->email = $request->input('email');
        $address->address = $request->input('address');
        $address->province = $request->input('province');
        $address->city = $request->input('city');
        $address->save();

        return redirect(route('my-address-book'))->with('success_message', __('frontend.address.update_address_successfully'));
    }

    public function deleteAddress(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        $address = UserAddress::find($request->input('id'));

        if(empty($address) || $address->user_id != auth()->user()->id){
            return redirect(route('my-address-book'))->with('error_message', __('frontend.address.address_not_existed'));
        }

        $address->delete();

        return redirect(route('my-address-book'))->with('success_message', __('frontend.address.update_address_successfully'));
    }

    public function changePassword(){
        return view('account.change-password');
    }

    public function updatePassword(Request $request){

        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error_message",__('frontend.account.current_password_not_matched'));
        }

        if(strcmp($request->get('password'), $request->get('new_password')) == 0){
            return redirect()->back()->with("error_message",__('frontend.account.same_password'));
        }

        $request->validate([
            'password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        return redirect()->back()->with("success_message",__('frontend.account.change_password_successfully'));
    }

    public function myOrders(){
        return view('account.orders',
        [
            'user'=> auth()->user()
        ]);
    }
}
