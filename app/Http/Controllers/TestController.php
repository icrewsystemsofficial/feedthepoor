<?php

namespace App\Http\Controllers;

use App\Jobs\TestJob;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function test()
    {
        $chennai_url = 'https://api.openweathermap.org/data/2.5/weather?q=Chennai&appid=777a367af263cfb27f7d5445074f9727';
        $chennai_response = file_get_contents($chennai_url);
        $chennaiData = json_decode($chennai_response, true);

        $mumbai_url = 'https://api.openweathermap.org/data/2.5/weather?q=Mumbai&appid=777a367af263cfb27f7d5445074f9727';
        $mumbai_response = file_get_contents($mumbai_url);
        $mumbaiData = json_decode($mumbai_response, true);

        $delhi_url = 'https://api.openweathermap.org/data/2.5/weather?q=Delhi&appid=777a367af263cfb27f7d5445074f9727';
        $delhi_response = file_get_contents($delhi_url);
        $delhiData = json_decode($delhi_response, true);

        $bangalore_url = 'https://api.openweathermap.org/data/2.5/weather?q=Bangalore&appid=777a367af263cfb27f7d5445074f9727';
        $bangalore_response = file_get_contents($bangalore_url);
        $bangaloreData = json_decode($bangalore_response, true);

        $kolkatta_url = 'https://api.openweathermap.org/data/2.5/weather?q=Goa&appid=777a367af263cfb27f7d5445074f9727';
        $kolkatta_response = file_get_contents($kolkatta_url);
        $kolkattaData = json_decode($kolkatta_response, true);

        $details_weather = [
            'email' => 'sathish@gmail.com',
            'chennai_weather' => $chennaiData["weather"][0]["main"],
            'mumbai_weather' => $mumbaiData["weather"][0]["main"],
            'delhi_weather' => $delhiData["weather"][0]["main"],
            'bangalore_weather' => $bangaloreData["weather"][0]["main"],
            'kolkatta_weather' => $kolkattaData["weather"][0]["main"]
        ];

        TestJob::dispatch($details_weather);
    }
}
