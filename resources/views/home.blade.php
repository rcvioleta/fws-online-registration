@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <stats-component :events="{{ $events }}" />
        </div>
    </div>
</div>
@endsection
