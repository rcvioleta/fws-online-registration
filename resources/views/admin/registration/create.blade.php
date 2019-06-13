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
                            <label for="id-number">ID Number</label>
                            <input 
                                type="text" 
                                id="id-number" 
                                name="emp_id" 
                                pattern="\d{5}"
                                maxlength="5"
                                class="form-control {{ $errors->has('emp_id') ? 'is-invalid' : '' }}" 
                                placeholder="ID Number"
                                value="{{ old('emp_id') }}">
                            @if ($errors->has('emp_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('emp_id') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="full-name">Full Name</label>
                            <input 
                                type="text" 
                                id="full-name" 
                                name="full_name" 
                                class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" 
                                placeholder="Employee full name"
                                value="{{ old('full_name') }}">
                            @if ($errors->has('full_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('full_name') }}
                                </div>
                            @endif
                        </div>
                        <button class="btn btn-md btn-primary">Add Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection