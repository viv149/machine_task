@extends('layout', ['active' => 'welcome', 'title' => 'Welcome'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 offset-md-4">
                <div class="card my-5" style="max-width: 540px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="{{url('image/bird.jpg')}}" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Welcome to MY APP</h5>
                          <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                          <a href="{{route('data.index')}}" class="btn btn-primary btn-sm"><strong>Test <i class="bi bi-arrow-right-short"></i></strong> </a>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
