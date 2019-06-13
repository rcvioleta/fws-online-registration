@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Events</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('event.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="event-name">Event Name</label>
                            <input 
                                type="text" 
                                id="event-name" 
                                name="event_name" 
                                class="form-control {{ $errors->has('event_name') ? 'is-invalid' : '' }}" 
                                placeholder="Name of the event"
                                value="{{ old('event_name') }}">
                            @if ($errors->has('event_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event_name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input 
                                type="date" 
                                id="date" 
                                name="date" 
                                class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" 
                                value="{{ old('date') }}">
                            @if ($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                        </div>
                        <button class="btn btn-md btn-primary">Save Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection