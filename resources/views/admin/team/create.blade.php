@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Teams</div>

                <div class="card-body">
                    <form action="{{ route('team.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="team-name">Team Name</label>
                            <input 
                                type="text" 
                                id="team-name" 
                                name="team_name" 
                                class="form-control {{ $errors->has('team_name') ? 'is-invalid' : '' }}" 
                                placeholder="Name of the team"
                                value="{{ old('team_name') }}">
                            @if ($errors->has('team_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('team_name') }}
                                </div>
                            @endif
                        </div>
                        <button class="btn btn-md btn-primary">Save Team</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection