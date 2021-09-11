@extends('auth.layout')
@section('title','Admin Login')
@section('content')
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="{{route('admin.login')}}" method="POST">
                @csrf
                @method('POST')

                @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> {{Session::get('error')}}
                    </div>
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}" name="username" placeholder="Username" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('username') 
                        <span class="invalid-feedback" style="display: block;">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}" name="password" placeholder="Password" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password') 
                        <span class="invalid-feedback" style="display: block;">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection