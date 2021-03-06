@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Campaign Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($campaigns as $campaign)
                        <tr>
                            <td>{{ $campaign->campaign_name }}</td>            
                            <td>
                                @if ($campaign->status === 0)
                                    <div class="badge badge-danger" disabled>Inactive</div>
                                @else
                                    <div class="badge badge-success" disabled>Active</div>
                                @endif
                            </td>            
                            <td class="text-center">
                                <a href="{{ route('campaign.edit', ['id' => $campaign->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                @if ($campaign->status === 0)
                                    <a href="{{ route('campaign.activate', ['id' => $campaign->id]) }}" class="btn btn-sm btn-success">Activate</a>
                                @else
                                    <a href="{{ route('campaign.deactivate', ['id' => $campaign->id]) }}" class="btn btn-sm btn-danger">Deactivate</a>
                                @endif
                            </td>            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="card">
                    <div class="card-header">Campaigns</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection