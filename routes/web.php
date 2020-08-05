<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/message', function() {
    // show a form
    return view('message');
});

Route::post('/message', function(Request $request) {
    Log::Info(env('NEXMO_API_KEY'));

    $url = "https://rest.nexmo.com/sms/json";
    // $url = "https://ljnexmo.eu.ngrok.io";
    $params = ["api_key" => env('NEXMO_API_KEY'),
        "api_secret" => env('NEXMO_API_SECRET'),
        "from" => env('NEXMO_NUMBER'),
        "to" => $request->input('number'),
        "text" => "Hello from Vonage and Laravel :)"
    ];

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', $url, ['query' => $params]);
    $data = $response->getBody();
    Log::Info($data);

    return view('thanks');
});

