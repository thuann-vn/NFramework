<?php

namespace App\Http\Controllers\Auth;

use App\Services\FbBot;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','linkFbMessenger', 'sendLinkFbMessengerRequest']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        session()->put('previousUrl', url()->previous());

        return view('auth.login');
    }

    // override logout so cart contents remain:
    // https://github.com/Crinsane/LaravelShoppingcart/issues/253
    public function logout(Request $request)
    {
        $cart = collect(session()->get('cart'));

        $destination = \Auth::logout();

        if (!config('cart.destroy_on_logout')) {
            $cart->each(function ($rows, $identifier) {
                session()->put('cart.' . $identifier, $rows);
            });
        }

        return redirect()->to($destination);
    }

    public function redirectTo()
    {
        return str_replace(url('/'), '', session()->get('previousUrl', '/'));
    }

    public function sendLinkFbMessengerRequest(Request $request){
        $fbBot = new FbBot();

        //Set persistent menu
        $persistentMenu = [
            'account_linking_url'=> route('link-fb-messenger'),
            'get_started' => ['payload' => 'ACCOUNT_LINK'],
            'persistent_menu'=>[
                [
                    'locale'=>'default',
                    'composer_input_disabled'=> false,
                    'call_to_actions'=>[
                        [
                            'title'=>'Connect with '. config('app.name'),
                            'type'=>'postback',
                            'payload'=>json_encode(['type'=>'ACCOUNT_LINK'])
                        ]
                    ]
                ]
            ]
        ];
        $fbBot->sendGraphAPI('me/messenger_profile', $persistentMenu);

        //Set start thread
        $startThreadParams = [
            'setting_type' => 'CALL_TO_ACTIONS',
            'thread_state' => 'NEW_THREAD',
            'call_to_actions' => [
                [
                    'payload' => json_encode([
                        'type' => 'ACCOUNT_LINK',
                    ]) ,
                ],
            ],
        ];

        $fbBot->sendGraphAPI('me/thread_settings',$startThreadParams);


        return redirect('https://m.me/botEbalo');
    }

    public function linkFbMessenger(Request $request){
        try{
            $fbBot = new FbBot();
            $result = $fbBot->sendGraphAPI('me',['fields'=>'recipient', 'account_linking_token'=> $request->input('account_linking_token')],'GET');
            $user = User::findOrFail(auth()->user()->id);
            $user->messenger_id = $result->recipient;
            $user->save();

            //Send complete message
            $params = [
                'recipient' => ['id' => $result->recipient],
                'message' => [
                    'attachment' => [
                        'type' => "template",
                        'payload' => [
                            'template_type' => 'button',
                            'text' => "Connected your messenger account with " . config('app.name') . ' successfully!',
                            'buttons' => [
                                [
                                    'type' => "web_url",
                                    'url' => route('voyager.dashboard'),
                                    'title' => "Back to Admin",
                                    'webview_height_ratio'=> "full"
                                ]
                            ]
                        ]
                    ]
                ]
            ];

            $result = $fbBot->sendGraphAPI('me/messages',$params);
            return redirect(route('voyager.dashboard'))->with('linked_success', 'Linked account successfully!');
        }catch (\Exception $exception){
            return redirect(route('voyager.dashboard'))->with('linked_failed', 'Linked account failed!');
        }
    }
}
