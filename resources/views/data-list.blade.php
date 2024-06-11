@extends('layout', ['active' => 'data', 'title' => 'Data'])

@section('content')
    <div class="container mt-3">
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
                        <form action="{{isset($findData) ? route('data.update', $findData->id) : route('data.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($findData))
                                @method('PUT')
                            @else
                                @method('POST')
                            @endif
                            <h2 class="text-center">FORM</h2>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{isset($findData) ? $findData->name : ''}}" placeholder="Enter your name" pattern="[a-zA-Z ]+" title="Only alphabetic characters are allowed" required>
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="{{isset($findData) ? $findData->email : ''}}">
                                @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="tel" name="mobile"  class="form-control" id="mobile" placeholder="Enter your mobile number" value="{{isset($findData) ? $findData->mobile : ''}}" pattern="[0-9]{10}" maxlength="10" minlength="10" required>
                                @error('mobile')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Profile Picture</label>
                                <input type="file" name="image" class="form-control" id="image" accept=".png,.jpg,.jpeg">
                                @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                @isset($findData)
                                    <img src="{{url('uploads/profile/'.$findData->image)}}" class="profile-img" alt="profile-pic">
                                @endisset
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                                @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm-password" placeholder="Re-enter your password">
                                @error('confirm_password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">{{isset($findData) ? 'Udate' : 'Save'}}</button>
                                @isset($findData)
                                    <a href="{{route('data.index')}}" class="btn btn-secondary">Cancel</a>
                                @endisset
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
                                    <th>Profile Pic</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile no.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $d)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>
                                            <img src="{{'uploads/profile/'.$d->image}}" class="profile-pic" alt="profile-pic">
                                        </td>
                                        <td>{{$d->name}}</td>
                                        <td>{{$d->email}}</td>
                                        <td>{{$d->mobile}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{route('data.edit', $d->id)}}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                                                <form action="{{route('data.destroy', $d->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm ms-2"><i class="bi bi-trash-fill"></i></button>
                                                </form>    
                                            </div>
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
