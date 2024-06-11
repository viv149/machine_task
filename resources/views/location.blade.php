@extends('layout', ['active' => 'location', 'title' => 'Location'])

@section('content')
    <div class="container mt-2">
        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <div>
                    {{ session('success')}}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <div>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6 offset-md-3 my-5">
                <div class="card shadow">
                    <div class="card-header">
                        <span class="text-center">Input location points</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('location.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="lat-1" class="form-label">Latitude 1</label>
                                    <input type="number" name="lat1" class="form-control" id="lat-1" step="any" value="{{isset($location) ? $location->lat1 : ''}}">
                                    @error('lat1')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="log-1" class="form-label">Longitude 1</label>
                                    <input type="number" name="log1" class="form-control" id="log-1" step="any" value="{{isset($location) ? $location->log1 : ''}}">
                                    @error('log1')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="lat-2" class="form-label">Latitude 2</label>
                                    <input type="number" name="lat2" class="form-control" id="lat-2" step="any" value="{{isset($location) ? $location->lat2 : ''}}">
                                    @error('lat2')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="log-2" class="form-label">Longitude 2</label>
                                    <input type="number" name="log2" class="form-control" id="log-2" step="any" value="{{isset($location) ? $location->log2 : ''}}">
                                    @error('log2')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-primary">Distance</button>
                            </div>
                        </form>
                        <div class="card-footer">
                            <div class="text-center">
                                <strong>{{ isset($location) ? $location->distance : '0' }} km</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

