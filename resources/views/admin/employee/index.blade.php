@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Employees</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <table class="table table-striped table-light">
                            <thead>
                                <tr>
                                    <th scope="col">ID Number</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Campaign</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->e_id }}</td>            
                                    <td>{{ $employee->full_name }}</td>            
                                    <td>{{ $employee->campaign->campaign_name }}</td>            
                                    <td>
                                        @if ($employee->status === 0)
                                            <button class="btn btn-sm btn-danger" disabled>Inactive</button>
                                        @else
                                            <button class="btn btn-sm btn-success" disabled>Active</button>
                                        @endif   
                                    </td>            
                                    <td>
                                        <a href="{{ route('employee.edit', ['id' => $employee->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @if ($employee->status === 0)
                                            <a href="{{ route('employee.activate', ['id' => $employee->id]) }}" class="btn btn-sm btn-success">Activate</a>
                                        @else
                                            <a href="{{ route('employee.deactivate', ['id' => $employee->id]) }}" class="btn btn-sm btn-danger">Deactivate</a>
                                        @endif
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