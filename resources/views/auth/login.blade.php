@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="message">
            <div class="img_1">
                <img src="images/Rectangle_6.png" alt="">
            </div>
            <div class="img_2">
                <img src="images/Rectangle_4.png" alt="">
            </div>
            <div class="img_3">
                <img src="images/Rectangle_36.png" alt="">
            </div>
            <div class="img_4">
                <img src="images/Vector_1" alt="">
            </div>
            <div class="img_5">
                <img src="images/Vector_2" alt="">
            </div>
        </div>
        <div class="login-form">
        <h3><b>Theproductyogi Blog</b></h3>
        <h5><b>Enter your Email and Password to Login</b></h5>
            <div class="card centered" style="width:100%">
           
                <form method="POST" action="{{ route('login') }}">
                    @csrf


                    <div class="col-md-11 m-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Enter your Email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-11 m-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Enter Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="remember-password m-3">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="login-btn m-3">
                        <button type="submit" class="btn btn-success col-8">
                            {{ __('Login') }}
                        </button>


                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
