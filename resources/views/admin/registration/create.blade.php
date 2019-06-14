@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Registration Form</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('registration.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="event">Event Name</label>
                            <select name="event_id" id="event" class="form-control">
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}">
                                        {{ $event->event_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            @if ($errors->has('campaign'))
                                <div class="alert alert-danger">You must select at least one campaign!</div>
                            @endif
                            <label for="">Select campaign to be included:</label>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input 
                                        type="checkbox" 
                                        class="form-check-input" 
                                        value="" 
                                        id="select-all"
                                        onchange="boxChecked(event)">
                                        <label class="form-check-label" for="select-all">
                                            Select All
                                        </label>
                                    </div>
                                </li>
                                @foreach ($campaigns as $campaign)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input 
                                                type="checkbox" 
                                                class="form-check-input" 
                                                name="campaign[]" 
                                                value="{{ $campaign->id }}" id="{{ $campaign->campaign_name }}">
                                            <label class="form-check-label" for="{{ $campaign->campaign_name }}">
                                                {{ $campaign->campaign_name }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary">Create Registration</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script>
    function boxChecked(event) {
        const inputArray = event.target.form

        if (event.target.checked) {
            event.target.checked = true
            Object.keys(inputArray).map(key => {
            if (inputArray[key].type === 'checkbox') {
                inputArray[key].checked = true
                }
            })
        } else {
            event.target.checked = false
                Object.keys(inputArray).map(key => {
                if (inputArray[key].type === 'checkbox') {
                    inputArray[key].checked = false
                }
            })
        }
    }
</script>
@endsection