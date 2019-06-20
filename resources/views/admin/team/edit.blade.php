@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">To Update: {{ $team->team_name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('team.update', ['id' => $team->id]) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="team-name">Team Name</label>
                            <input 
                                type="text" 
                                id="team-name" 
                                name="team_name" 
                                class="form-control {{ $errors->has('team_name') ? 'is-invalid' : '' }}" 
                                placeholder="Name of the team"
                                value="{{ $team->team_name }}">
                            @if ($errors->has('team_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('team_name') }}
                                </div>
                            @endif
                        </div>
                        <button class="btn btn-md btn-primary">Update Team</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection