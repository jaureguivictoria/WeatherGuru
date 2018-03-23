@extends('layout.base')

@section('content')
    
    <main role="main" class="container">
        <div class="starter-template">
            
            @include('shared.side-logo')
            
            <h3 class="font-weight-bold mt-3">{{$location}}</h3>
            
            @include('shared.errors')
            
            <h4 class="mt-4">{{trans('messages.forecast')}}</h4>
            
            <div class="container mt-3">
                <div class="row">
                    @foreach ($daily as $day)
                        @include('daily-forecast')
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="form-inline mb-5">
            <div class="mx-auto">
                <a href="{{url('historical/search').'?'.$_SERVER['QUERY_STRING']}}" class="btn btn-secondary mr-2">{{trans('messages.historical')}}</a>
                <a href="{{url('/')}}" id="getHistorical" class="btn btn-info">{{trans('messages.home')}}</a>
            </div>
        </div>
        
    </main>
    
@endsection