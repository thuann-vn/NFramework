<?php

namespace App\Services;

use App\Order;
use App\User;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

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

    /**
     * @param $url
     * @param $params
     * @param $method
     */

    public function sendGraphAPI($url, $params, $method = 'POST'){
        try{
            $url = config('shop.fb_graph') .  $url . '?access_token='.config('shop.fb_token');
            $params['access_token'] =  $this->accessToken;
            if($method=='POST'){
                $data = ['json' => $params];

                $client = new \GuzzleHttp\Client;
                return $client->request($method , $url,  $data);
            }else{
                foreach ($params as $key=> $param){
                    $url .= '&'.$key . '=' . $param;
                }
                $client = new \GuzzleHttp\Client();
                $response =  $client->get($url);
                return json_decode($response->getBody()->getContents());
            }
        }catch (\Exception $exception){
            dd($exception);
            Log::error('SEND MESSAGE FAILED', [$params, $exception->getCode(), $exception->getMessage()]);
            return null;
        }
    }
}
