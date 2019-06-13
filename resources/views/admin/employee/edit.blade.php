@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">To Update: {{ $employee->full_name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('employee.update', ['id' => $employee->id]) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="id-number">ID Number</label>
                            <input 
                                type="text" 
                                id="id-number" 
                                name="emp_id" 
                                pattern="\d{4,5}"
                                maxlength="5"
                                class="form-control {{ $errors->has('emp_id') ? 'is-invalid' : '' }}" 
                                placeholder="ID Number"
                                value="{{ $employee->emp_id }}">
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
                                value="{{ $employee->full_name }}">
                            @if ($errors->has('full_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('full_name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="campaign">Campaign</label>
                            <select name="campaign_id" id="campaign" class="form-control {{ $errors->has('campaign_id') ? 'is-invalid' : '' }}">
                                @foreach ($campaigns as $campaign)
                                    @if ($campaign->id === $employee->campaign_id)
                                        <option value="{{ $campaign->id }}" selected>
                                            {{ $campaign->campaign_name }}
                                        </option>
                                    @else
                                        <option value="{{ $campaign->id }}">
                                            {{ $campaign->campaign_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('campaign_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('campaign_id') }}
                                </div>
                            @endif
                        </div>
                        <button class="btn btn-md btn-primary">Update Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection