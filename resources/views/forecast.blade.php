@extends('layout.base')

@section('scripts')

@endsection

@section('styles')
    
@endsection

@section('content')    
    <main role="main" class="container" id="app">
        <div class="starter-template">
            <div class="form-inline">
                <a href="{{url('/')}}">
                    <img src="{{url('img/logo.png')}}" alt="WeatherGuru" class="mx-auto d-block mt-3" width="64">
                </a>
                <h2 class="mt-3 ml-3">Weather Guru</h2>
            </div>
            
            <h3 class="font-weight-bold mt-3">{{$location}}</h3>
            
            <h4 class="mt-4">{{trans('messages.forecast')}}</h4>
            <div class="container mt-3">
                <div class="row">
                    @foreach ($daily as $day)
                        @include('daily-forecast')
                    @endforeach
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <a href="{{ url('/') }}" class="btn btn-info">{{trans('messages.home')}}</a>
            </div>
        </div>
    </main>
@endsection