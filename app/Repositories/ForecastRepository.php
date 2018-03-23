<?php

namespace WeatherGuru\Repositories;

use Cache;
use DarkSky;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Carbon\Carbon;

class ForecastRepository
{
    /**
     * Get the next 7 days forecast for a given location in a specific unit
     * @method getForecast
     * @param  decimal     $lat  Latitude
     * @param  decimal     $lng  Longitude
     * @param  string      $unit Metric (si) or Imperial (us)
     * @return array
     */
    public function getForecast($lat, $lng, $unit)
    {
        $expire = now()->addHours(1);
        $cacheKey = "forecast_{$lat}_{$lng}_{$unit}";
        
        $results = Cache::remember($cacheKey, $expire, function() use ($lat, $lng, $unit) {
            
            return DarkSky::location($lat, $lng)
                            ->includes(['daily'])
                            ->units($unit)
                            ->get();
        });
        
        return $results->daily->data;
    }
    
    /**
     * Obtain the last 30 days forecast for a given location in a specific unit
     * @method getHistoricalForecast
     * @param  decimal     $lat  Latitude
     * @param  decimal     $lng  Longitude
     * @param  string      $unit Metric (si) or Imperial (us)
     * @return array
     */
    public function getHistoricalForecast($lat, $lng, $unit)
    {
        try {
            $results = [];
            $expire = now()->addHours(1);
            $cacheKey = "historical_{$lat}_{$lng}_{$unit}";
            
            $results = Cache::remember($cacheKey, $expire, function() use ($lat, $lng, $unit) {
                
                $requests = $this->sendMultipleRequestsConcurrently($lat, $lng, $unit);
                
                return $this->parseMultipleResponses($requests);
            });
            
            return $results;
            
        } catch (\Exception $e) {
            \Log::error($e);
            return [];
        }
    }
    
    /**
     * Initiate each request but do not block
     * @method sendMultipleRequestsConcurrently
     * @param  decimal     $lat  Latitude
     * @param  decimal     $lng  Longitude
     * @param  string      $unit Metric (si) or Imperial (us)
     * @return array            [GuzzleHttp\Psr7\Request]
     */
    private function sendMultipleRequestsConcurrently($lat, $lng, $unit)
    {
        $requests = [];
        $parameters = [
            'excludes' => 'currently,minutely,hourly,alerts',
            'units' => $unit
        ];
        
        $client = new Client([
            'base_uri' => config('dark_sky.base_uri').
                          "forecast/".env('DARKSKY_API_KEY')."/"
        ]);
        
        $totalDays = 30;
        $date = Carbon::now()->subDays($totalDays);
        $i = 0;
        
        while($i < $totalDays) {
            $requests[$date->timestamp] = $client->getAsync(
                "{$lat},{$lng},{$date->timestamp}?".
                urldecode(http_build_query($parameters))
            );
            $date->addDay();
            $i++;
        }
        
        return $requests;
    }
    
    /**
     * Wait on all of the requests to complete and process results
     * @method parseMultipleResponses
     * @param  array    $requests [GuzzleHttp\Psr7\Request]
     * @return array    $results
     */
    private function parseMultipleResponses($requests)
    {
        $results = [];
        $responses = Promise\unwrap($requests);
        
        foreach ($responses as $response) {
            $contents = json_decode($response->getBody()->getContents());
            $results[] = $contents->daily->data[0];
        }
        
        return $results;
    }
}

