# Weather Guru
Weather Guru is an application that allows the user to view the observed (in the past 30 days) or forecasted (in the future) daily weather conditions for a given location using the [Dark Sky API](https://darksky.net/dev/docs).

It is made using PHP 7 and Laravel Framework.

## Demo

Check it live in here: http://weather-guru.herokuapp.com/

## Views

There are 3 views:
* The **home page**: where to input the location and choose the unit (metric/imperial) for the results.
* The **forecast page**: where the current week forecast is displayed.
* The **historical forecast page**: where you can see the past 30 days forecast for that location.

### Frameworks used

* Laravel 5.6
* jQuery
* BootStrap

### Plugins installed
* [jQuery validation](https://jqueryvalidation.org/validate/)
* [Laravel Guzzle](https://github.com/guzzle/guzzle)
* [Laravel Dark Sky](https://packagist.org/packages/naughtonium/laravel-dark-sky) 

### APIs used

* [Dark Sky API](https://darksky.net/dev)
* [Google Maps JavaScript API](https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform)

### Considerations taken
As suggested in the Dark Sky documentation, I made use of the Laravel Dark Sky API wrapper. This was easy to use to grab the 7 day forecast results.

For obtaining the historical results, I implemented Guzzle to send multiple requests concurrently using promises and asynchronous requests. See: http://docs.guzzlephp.org/en/stable/quickstart.html#concurrent-requests

### Environment configurations

* GOOGLE_MAPS_JS_API_KEY
* DARKSKY_API_KEY
