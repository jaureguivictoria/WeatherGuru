<?php

namespace WeatherGuru\Http\Controllers;

use Illuminate\Http\Request;
use WeatherGuru\Http\Requests\SearchForecastRequest;
use WeatherGuru\Repositories\ForecastRepository;

class ForecastController extends Controller
{
    /** @var  ForecastRepository */
    private $forecastRepository;
    
    public function __construct(ForecastRepository $forecastRepository){
        $this->forecastRepository = $forecastRepository;
    }
    
    /**
     * Search the next 8 day forecast for a given location using a specific unit 
     * @method search
     * @param  Request $request
     * @return Response
     */
    public function search(SearchForecastRequest $request)
    {
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $unit = $request->get('unit','si');
    
        $results = $this->forecastRepository->getForecast($lat, $lng, $unit);
        
        return view('forecast')
                ->with('location', $request->get('location'))
                ->with('unit', $unit)
                ->with('daily', $results);
    }
    
    /**
     * Search the past 30 day forecast for a given location using a specific unit 
     * @method historicalSearch
     * @param  Request $request
     * @return Response
     */
    public function historicalSearch(SearchForecastRequest $request)
    {
        $expire = now()->addHours(1);
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $unit = $request->get('unit','si');
        
        $results = $this->forecastRepository->getHistoricalForecast($lat, $lng, $unit);

        return view('historical')
                ->with('location', $request->get('location'))
                ->with('unit', $unit)
                ->with('daily', $results);
    }
}
