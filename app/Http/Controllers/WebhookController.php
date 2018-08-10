<?php

namespace App\Http\Controllers;

use App\Services\FbBot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWebhook(Request $request)
    {
        Log::error('received get', $request->all());
        if ($request->get('hub_mode') == 'subscribe' and $request->get('hub_verify_token') === env('HUB_VERIFY_TOKEN')) {
            return response($request->input('hub_challenge'));
        }
        return response('Error, verify token doesn\'t match', 400);
    }

    //whenever Facebook Messenger get message from the user,
    //Facebook Messenger will send to our Laravel project here
    public function postWebhook(Request $request)
    {
        Log::info('received event', $request->all());
        $content = json_decode($request->getContent() , true);
        //check if the content of the request contain messaging property, if not exist set it as null
        $postArray = isset($content['entry'][0]['messaging']) ? $content['entry'][0]['messaging'] : null;
        $response = [];

        //Check if get started
        if (!is_null($postArray)) {
            $sender = $postArray[0]['sender']['id'];
            $postback = isset($postArray[0]['postback']['payload'])?json_decode($postArray[0]['postback']['payload']):null;
            if(!empty($postback) && $postback->type == 'ACCOUNT_LINK'){
                $params = [
                    'recipient' => ['id' => $sender],
                    'message' => [
                        'attachment' => [
                            "type"=>"template",
                            "payload"=>[
                                "template_type"=>"button",
                                "text"=>"CONNECT YOUR ACCOUNT WITH ". config('app.name'),
                                "buttons"=>[
                                    ["type"=> "account_link","url"=> route('link-fb-messenger')]
                                ]
                            ]
                        ]
                    ]
                ];
                $fbBot = new FbBot();
                $response = $fbBot->sendGraphAPI('me/messages',$params);
            }
        }
        return response($response, 200);
    }
}
