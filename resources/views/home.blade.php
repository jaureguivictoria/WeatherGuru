@extends('layout.base')

@section('scripts')
    <script defer src="{{ asset('/js/maps.js') }}"></script>
    <script defer src="{{ asset('/js/home.js') }}"></script>
    <script defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={!!env('GOOGLE_MAPS_JS_API_KEY')!!}&libraries=places&callback=initAutocomplete"></script>
    
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/maps.css') }}">
@endsection

@section('content')
    <div class="container">
        <a href="{{url('/')}}">
            <img src="{{url('img/logo.png')}}" alt="WeatherGuru" class="mx-auto d-block mt-5">
        </a>
    </div>
    <main role="main" class="container" id="app">
        <div class="starter-template">
            <h1>{{trans('messages.welcome')}}</h1>
            
            <p class="lead">
                {{trans('messages.subtitle')}}
            </p>
            {!! Form::open(['url' => 'search', 'method' => 'get', 'id' => 'searchForm']) !!}
                <div class="form-group">
                    <div class="col-md-6 offset-md-3 mt-5">
                        <div id="locationField">
                            <input id="autocomplete" placeholder="{{trans('messages.enter_location')}}" onFocus="geolocate()" type="text" class="form-control required"></input>
                            {!! Form::hidden('lat',null,['id'=>'lat']) !!}
                            {!! Form::hidden('lng',null,['id'=>'lng']) !!}
                            {!! Form::hidden('location',null,['id'=>'location']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="col-md-3 offset-md-4">
                        {!! Form::select('unit', ['si' => trans('units.metric'), 'us' => trans('units.imperial')],'si',['class' => 'form-control mt-4']) !!}
                        {!! Form::submit(trans('messages.forecast'),['class' => 'btn btn-info mt-4']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </main>
@endsection