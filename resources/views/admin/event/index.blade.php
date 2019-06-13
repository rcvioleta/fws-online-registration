@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Events</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <table class="table table-striped table-light">
                            <thead>
                                <tr>
                                    <th scope="col">Event Name</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->event_name }}</td>            
                                    <td>{{ $event->year }}</td>            
                                    <td>
                                        <a href="{{ route('event.edit', ['id' => $event->id]) }}" class="btn btn-sm btn-success">Edit</a>
                                        <a href="{{ route('event.destroy', ['id' => $event->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>            
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection