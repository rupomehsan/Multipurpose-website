<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OpenAiController extends Controller
{
    public function suggestBusinessName(Request $request)
    {
        $prompt = $request->input('prompt');
        $prompt =  "$prompt suggest 10 unique business business name for domain";
        
        $apiKey = config('app.openai_api_key');

        $client = new Client();
        $response = $client->post('https://api.openai.com/v1/engines/text-davinci-003/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
            ],
            'json' => [
                'prompt' => $prompt,
                'max_tokens' => 50,
            ],
        ]);
        $businessName = json_decode($response->getBody())->choices[0]->text;
        $businessNameArray = explode("\n", trim($businessName));
        $businessNameArray = array_filter($businessNameArray, 'strlen');
        $businessNameArray = array_map(function($element) {
            return trim(explode('.', $element)[1]);
            }, $businessNameArray);
            
            $view = view('landlord.frontend.user.business-item',compact('businessNameArray'));
        return $view;
    }
}
