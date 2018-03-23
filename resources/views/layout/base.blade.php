<!doctype html>
<html lang="{{ app()->getLocale() }}">

    <head>
        @include('layout.head')
    </head>
    
    <body>
        <div id="powered_by" class="fixed-top text-right p-2">
            <span class="p-3">{{trans('messages.powered_by')}} 
                <a href="https://darksky.net/poweredby/" class="font-weight-bold">Dark Sky API</a>
            </span>
        </div>
        
        @yield('content')
        
        <div id="loader" class="invisible"></div>
        
    </body>
    
    {{-- <footer class="fixed-bottom">
        <p class="text-center">{{trans('messages.powered_by')}} 
            <a href="https://darksky.net/poweredby/" class="font-weight-bold">Dark Sky API</a>
        </p>
    </footer> --}}
    
</html>
