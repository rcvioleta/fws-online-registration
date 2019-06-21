@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card">
                <div class="card-header">Teams</div>

                <div class="card-body">
            
                </div>
            </div> --}}
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Team Name</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $team)
                    <tr>
                        <td>{{ $team->team_name }}</td>              
                        <td>
                            @if ($team->status === 0)
                                <div class="badge badge-danger">Inactive</div>
                            @else
                                <div class="badge badge-success">Active</div>
                            @endif    
                        </td>              
                        <td class="text-center">
                            <a href="{{ route('team.edit', ['id' => $team->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                            @if ($team->status === 0)
                                <a href="{{ route('team.activate', ['id' => $team->id]) }}" class="btn btn-sm btn-success">Activate</a>
                            @else
                                <a href="{{ route('team.deactivate', ['id' => $team->id]) }}" class="btn btn-sm btn-danger">Deactivate</a>
                            @endif
                        </td>            
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection