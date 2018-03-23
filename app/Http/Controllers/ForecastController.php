<?php

namespace WeatherGuru\Http\Controllers;

use Illuminate\Http\Request;
use WeatherGuru\Http\Requests\SearchForecastRequest;
use DarkSky;
use Cache;
use Response;

class ForecastController extends Controller
{
    /**
     * Search the next 8 day forecast for a given location using a specific unit 
     * @method search
     * @param  Request $request
     * @return Response
     */
    public function search(SearchForecastRequest $request)
    {
        $expire = now()->addHours(1);
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $unit = $request->get('unit','si');
        $cacheKey = "forecast_{$lat}_{$lng}_{$unit}";
        
        $results = Cache::remember($cacheKey, $expire, function() use ($lat, $lng, $unit) {
            return DarkSky::location($lat, $lng)
                            ->includes(['daily'])
                            ->units($unit)
                            ->get();
        });
        
        return view('forecast')
                ->with('location', $request->get('location'))
                ->with('unit', $unit)
                ->with('daily', $results->daily->data);
    }
}
