@extends('layout.base')

@section('content')
    
    <main role="main" class="container">
        <div class="starter-template">
            
            @include('shared.side-logo')
            
            <h3 class="font-weight-bold mt-3">{{$location}}</h3>
            
            @include('shared.errors')
            
            <h4 class="mt-4">{{trans('messages.historical')}}</h4>

            <div id="historical" class="container mt-3">
                <table class="table table-responsive table-bordered">
                    <tbody>
                        @foreach (array_chunk($daily,7) as $week)
                        <tr>
                            @foreach($week as $day)
                                @php
                                    $date = \Carbon\Carbon::createFromTimestamp($day->time);
                                @endphp
                                <td>
                                    <p>{{$date->format('D d/m')}}</p>
                                    <div class="text-center">
                                        <img src="{{ asset('img/'.$day->icon.'.png')}}" width="64" height="64" title="{{$day->summary}}">
                                    </div>
                                    <div class="mt-2">
                                        <span class="badge badge-primary col-md-12">{{$day->temperatureMin}} {{trans('units.'.$unit)}}</span>
                                        <span class="badge badge-secondary col-md-12">{{$day->temperatureMax}} {{trans('units.'.$unit)}}</span>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="form-inline mb-5">
            <div class="mx-auto">
                <a href="{{url('search').'?'.$_SERVER['QUERY_STRING']}}" class="btn btn-secondary mr-2">{{trans('messages.forecast')}}</a>
                <a href="{{url('/')}}" class="btn btn-info">{{trans('messages.home')}}</a>
            </div>
        </div>
        
    </main>
    
@endsection