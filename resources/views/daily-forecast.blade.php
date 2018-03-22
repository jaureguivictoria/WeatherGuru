<div class="col-sm mt-2">
    <strong>
        @php
            $date = \Carbon\Carbon::createFromTimestamp($day->time);
        @endphp
        @if ($date->isToday())
            {{ trans('messages.today')}}
        @else
            {{ $date->format('l')}}
        @endif
        <p> {{$date->format('d/m')}}</p>
    </strong>
    <img src="{{ asset('img/'.$day->icon.'.png')}}" width="64" height="64">
    <div class="mt-2">
        <span class="badge badge-primary col-md-12">{{$day->temperatureMin}} {{trans('units.'.$unit)}}</span>
        <span class="badge badge-secondary col-md-12">{{$day->temperatureMax}} {{trans('units.'.$unit)}}</span>
    </div>
    <p>{{$day->summary}}</p>
</div>
