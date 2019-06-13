@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">To Update: {{ $campaign->campaign_name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('campaign.update', ['id' => $campaign->id]) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="campaign-name">Campaign Name</label>
                            <input 
                                type="text" 
                                id="campaign-name" 
                                name="campaign_name" 
                                class="form-control {{ $errors->has('campaign_name') ? 'is-invalid' : '' }}" 
                                placeholder="Name of the campaign"
                                value="{{ $campaign->campaign_name }}">
                            @if ($errors->has('campaign_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('campaign_name') }}
                                </div>
                            @endif
                        </div>
                        <button class="btn btn-md btn-primary">Update Campaign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection