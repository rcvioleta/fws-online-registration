@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Employee</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('employee.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id-number">ID Number</label>
                            <input 
                                type="text" 
                                id="id-number" 
                                name="e_id" 
                                pattern="\d{5}"
                                maxlength="5"
                                class="form-control {{ $errors->has('e_id') ? 'is-invalid' : '' }}" 
                                placeholder="ID Number"
                                value="{{ old('e_id') }}">
                            @if ($errors->has('e_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('e_id') }}
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
                        <div class="form-group">
                            <label for="campaign">Campaign</label>
                            <select name="campaign_id" id="campaign" class="form-control {{ $errors->has('campaign_id') ? 'is-invalid' : '' }}">
                                <option value="" selected disabled>Select Campaign</option>
                                @foreach ($campaigns as $campaign)
                                    <option value="{{ $campaign->id }}">
                                        {{ $campaign->campaign_name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('campaign_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('campaign_id') }}
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