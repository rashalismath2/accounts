@extends('layouts.app')

@section('content')
<div class="container">
    <div id="login-container">
        <div id="login-logo">
            <img src="{{ asset('images/logo.svg') }}" alt="" srcset="">
        </div>
        <div id="login-form">
            <p>Login to start your session</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-input input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><span class="oi oi-envelope-closed"></span></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Email" aria-label="email" aria-describedby="basic-addon1">
                          
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="login-input input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><span class="oi oi-key"></span></span>
                    </div>
                    <input type="password" class="form-control" placeholder="Password" aria-label="email" aria-describedby="basic-addon1">
                          
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
      
                <div class="login-input">
                    <div id="login-remember">
                        <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <p>Remember me</p>
                    </div>
                </div>
        
                <div class="login-input">
                    <div id="login-submit">
                        <button type="submit" class="">
                            {{ __('Login') }}
                        </button>
        
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
