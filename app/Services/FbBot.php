<?php

namespace App\Services;

class FbBot
{
    private $accessToken = null;
    function __construct($accessToken=null)
    {
        if (!empty($accessToken)) {
            $this->accessToken = $accessToken;
        } else {
            $this->accessToken = config('shop.fb_token');
        }
    }

    public function sendMessage($receivePhoneNumber, $message)
    {
        try
        {
            $client = new \GuzzleHttp\Client();
            $url = "https://graph.facebook.com/v2.6/me/messages";

            $params = ['recipient' => ['phone_number' => $receivePhoneNumber], 'message' => ['text' => $message], 'access_token' => $this->accessToken];

            $header = array(
                'content-type' => 'application/json'
            );

            $response = $client->post($url, ['query' => $params, 'headers' => $header]);
            // file_put_contents("payytorrrr.json", json_encode($response));
            return true;
        }
        catch(\GuzzleHttp\Exception\RequestException $e)
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
    }
}
?>