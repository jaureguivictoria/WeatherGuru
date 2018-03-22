<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layout.head')
    </head>
    <body>
        @yield('content')
    </body>
    <footer>
        <p class="text-center">{{trans('messages.powered_by')}} 
            <a href="https://darksky.net/" class="font-weight-bold">Dark Sky API</a>
        </p>
    </footer>
</html>
