<?php

namespace App\Console\Commands;

use App\Models\GPT;
use App\Models\Setting;
use App\Models\Tweet;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenAI\Laravel\Facades\OpenAI;
use Carbon\Carbon;

class TweetPostingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tweet-posting-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{

    $time_schedule = GPT::all();

    foreach ($time_schedule as $item) {
        $itemTime = Carbon::parse($item->time); // Parse the time from the database
        $currentTime = Carbon::now(); // Get the current time

        if ($itemTime->format('H:i:s') === $currentTime->format('H:i:s')) { // Compare only the time part

            $benefits = OpenAI::chat()->create([
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'user', 'content' => "Write Two Lines Of Tweet About " . $item->text],
                ],
                "temperature" => 0.2,
                "top_p" => 1,
                "frequency_penalty" => 0,
                "presence_penalty" => 0,
            ]);

            $content = $benefits->choices[0]->message->content;

            $user_id = $item->user_id;
            $user = Setting::where('user_id', $user_id)->first();

            $baseUrl = 'https://api.twitter.com/2/tweets';

            // Your Twitter API credentials
            $consumerKey = $user->consumer_key;
            $consumerSecret = $user->consumer_secret; // Corrected the spelling
            $accessToken = $user->consumer_access_token;
            $accessTokenSecret = $user->consumer_token_secret; // Corrected the spelling

            // POST data (text you wish to Tweet)
            $data = [
                'text' => $content,
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
                return back()->with('success', 'New Tweet has been created successfully');
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


}
}
