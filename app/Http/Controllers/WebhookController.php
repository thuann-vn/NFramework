<?php

namespace App\Http\Controllers;

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
        $content = json_decode($request->getContent() , true);
        //check if the content of the request contain messaging property, if not exist set it as null
        $postArray = isset($content['entry'][0]['messaging']) ? $content['entry'][0]['messaging'] : null;
        $response = [];
        $has_message = false;
        $is_echo = true;

        if (!is_null($postArray)) {
            $sender = $postArray[0]['sender']['id'];
            $has_message = isset($postArray[0]['message']['text']);
            //if the message contain is_echo, it means it doesnt contain user message
            $is_echo = isset($postArray[0]['message']['is_echo']);
        }
        if ($has_message && !$is_echo) {
            //for now, we will just reply back the same thing as user send
            $reply = $postArray[0]['message']['text'];
            $response = $this->sendToFbMessenger($sender, $reply);
        }
        return response($response, 200);
    }
    //after we process the message on above, let send message to the user
    //back in Facebook Messenger
    protected function sendToFbMessenger($sender, $message)
    {
        //message
        $data = ['json' =>
            [
                'recipient' => ['id' => $sender],
                'message' => ['text' => $message],
            ]
        ];
        $client = new \GuzzleHttp\Client;
        $res = $client->request('POST', 'https://graph.facebook.com/v2.6/me/messages?access_token='.env('FB_TOKEN'),  $data);
        return $res->getBody();
    }
}
