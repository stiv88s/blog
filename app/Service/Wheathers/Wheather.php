<?php


namespace App\Service\Wheathers;


use http\Client\Request;
use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Wheather
{
    public function load($city)
    {
        if ($city != null) {

            $wheather = $this->getCityWheater($city);

            if(Auth::check()){
                Auth::user()->prefered_city = $city;
                Auth::user()->save();
            }else{
                $city = Session::put('city', $city);

            }
            return $wheather;

        } else {
            return back();
        }
    }

    public function getWheather()
    {
//        https://rapidapi.com/community/api/open-weather-map
//        https://rapidapi.com/developer/billing/subscriptions-and-usage
        if (Auth::check()) {

            if (Auth::user()->prefered_city) {
                $city = Auth::user()->prefered_city;
            } else {
                if ($this->getIp() != null) {
                    $clientIp = $this->getIp();
                    $client = new Client();
                    $request = $client->get("http://ip-api.com/json/$clientIp?fields=city");
                    $json = json_decode($request->getBody(), true);
                    $city = $json['city'];
                } else {
                    $city = 'Chicago';
                }
                Auth::user()->prefered_city = $city;
                Auth::user()->save();
            }

        } else {
            if (Session::get('city')) {
                $city = Session::get('city');
            } else {

                if ($this->getIp() != null) {
                    $clientIp = $this->getIp();
                    $client = new Client();
                    $request = $client->get("http://ip-api.com/json/$clientIp?fields=city");
                    $json = json_decode($request->getBody(), true);
                    $city = $json['city'];
                    Session::put('city', $city);
                    Session::save();
                } else {
                    $city = 'Chicago';
                }

            }

        }

        $wheather = $this->getCityWheater($city);

        return $wheather;

    }

    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {

                foreach (explode(',', $_SERVER[$key]) as $ip) {

                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    protected function getCityWheater($city)
    {

        try {
            $wheather = Cache::remember("city." . $city, 420, function () use ($city) {
                $client = new Client();
                $postData = [
                    'headers' => [
                        'Accept' => 'application/json',
                        'x-rapidapi-host' => 'community-open-weather-map.p.rapidapi.com',
                        'x-rapidapi-key' => env('RAPIDAPI_KEY')
                    ],
                ];

                $request = $client->get("https://community-open-weather-map.p.rapidapi.com/weather?q={$city}", $postData);
                $json = json_decode($request->getBody(), true);
                return $json;

            });
            return $wheather;

        } catch (\Exception $e) {

            return ['error' => 'city not found'];

        }

    }


}
