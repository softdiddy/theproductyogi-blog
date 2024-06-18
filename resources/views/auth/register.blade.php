@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="login-form">
            <h1><b>Hi Dear</b></h1>

            <h5>Welcome to Sabicode, we are ready to get you started?</h5>

            <div class="card" style="width:100%">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="col-md-11 m-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                            placeholder="Enter Fullname">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-11 m-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="Enter your Email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-11 m-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password" placeholder="Enter your Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-11 m-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Re-enter Password">
                    </div>

                    <div class="col-md-11 m-3 offset-md-4">
                        <button type="submit" class="btn btn-success col-8">
                            {{ __('Register') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <div class="message">
            <div class="code1"><img src="images/UMSgb.gif" alt=""></div>
        </div>
    </div>
@endsection
