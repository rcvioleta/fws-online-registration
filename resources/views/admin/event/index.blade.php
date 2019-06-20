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
                                    <th scope="col">Date</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->event_name }}</td>            
                                    <td>{{ $event->date }}</td>            
                                    <td class="text-center">
                                        <a href="{{ route('event.edit', ['id' => $event->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                        {{-- <a href="{{ route('event.destroy', ['id' => $event->id]) }}" class="btn btn-sm btn-danger">Delete</a> --}}
                                        <a href="{{ route('event.history', ['id' => $event->id]) }}" onclick="generateReport(event)" class="btn btn-sm btn-success">Generate Report</a>
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

@section('custom-js')
    <script>
        function generateReport(event) {
            event.preventDefault()
            const route = event.srcElement.href
            fetch(route)
            .then(response => response.json())
            .then(result => {
                console.log('data', result)
                if (!result.data) alert('No history to show!')
                else window.location.href = `/event/${result.id}/print`
            })
            .catch(err => console.log(err))
        }
    </script>
@endsection