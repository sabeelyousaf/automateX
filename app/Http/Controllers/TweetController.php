<?php

namespace App\Http\Controllers;
use App\Models\Tweet;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TweetController extends Controller
{

    public function postTweet(Request $request)
    {
        // Twitter API base URL
        $baseUrl = 'https://api.twitter.com/2/tweets';

        // Your Twitter API credentials
        $consumerKey = 'U2j7rjKRvfJBbNcCtTU1qvGT3';
        $consumerSecret = 'ket8IuweI4FbJ5SwU8GkpxdWeSSJlpTq4rfi42HFJy3rZ8GqXE';
        $accessToken = '1774182005938311168-nwX5n8Bts3CNgLZDt1kcq5pEdgiUDu';
        $accessTokenSecret = 'p8YC9g3yn8OBIX3cvulLMrJFDJgw6a7WL95f43dpre5sB';

        // POST data (text you wish to Tweet)
        $data = [
            'text' => "BABE",
        ];

        // Initialize Guzzle client with OAuth1 authentication
        $stack = HandlerStack::create();
        $middleware = new Oauth1([
            'consumer_key' => $consumerKey,
            'consumer_secret' => $consumerSecret,
            'token' => $accessToken,
            'token_secret' => $accessTokenSecret
        ]);

        $stack->push($middleware);

        $client = new Client([
            'base_uri' => $baseUrl,
            'handler' => $stack,
            'auth' => 'oauth'
        ]);

        try {
            // Make the POST request
            $response = $client->post('', [
                'json' => $data
            ]);

            // Get the response body
            $responseData = json_decode($response->getBody()->getContents(), true); // Decode JSON response
            $text = $responseData['data']['text']; // Access text from response data

            // Handle the response data as needed
            return back()->with('success','New Tweet has been created successfully');
        } catch (RequestException $e) {
            // Handle request errors
            if ($e->hasResponse()) {
                $errorResponse = $e->getResponse();
                $errorMessage = $errorResponse->getBody()->getContents();
                dd($errorMessage);
            } else {
                dd($e->getMessage());
            }
        }
    }

}
