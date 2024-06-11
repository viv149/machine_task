@extends('layout', ['active' => 'audio', 'title' => 'Audio Text'])

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
            <div class="col-md-4 offset-md-4 my-5">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('audio.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            
                            <div class="mb-3">
                                <label for="image" class="form-label">Audio file</label>
                                <input type="file" name="audio" class="form-control" id="image" accept=".mp3,.wav,.aac,.flac,.ogg">
                                @error('audio')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-12 my-5">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Audio</th>
                                    <th>Duration</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($audio)
                                    @foreach ($audio as $index => $d)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>
                                                <audio controls>
                                                    <source src="{{ url('uploads/audio/'.$d->name) }}" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </td>
                                            <td>{{ $d->duration }} sec</td>
                                            
                                            <td>
                                                <form action="{{route('audio.destroy', $d->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach    
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
