@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($event_records as $event_record)
                <div class="card mb-4">
                    <div class="card-header">{{$event_record['event_name']}} </div>
                    <div class="card-body">
                        <strong>Attendance Rate</strong>
                        <div class="bg-light text-white">
                            @if ($event_record['percentage'])
                                <div class="p-1 bg-success text-right" style="width: {{$event_record['percentage'].'%'}}">
                                    {{$event_record['percentage'].'%'}}
                                </div>
                            @else
                                <div class="p-1 text-left">
                                    {{$event_record['percentage'].'%'}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
