@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header" style="background-color: #0d1a80; color:white;">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end" placeholder="Enter full name">{{ __('') }}</label> --}}

                            {{-- <div class="col-md-6"> --}}
                                <center>
                                <input id="email" type="email" title = "Please input email address" style="width: 65%" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </center>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            {{-- </div> --}}
                        </div>

                        <div class="row mb-3">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label> --}}

                            {{-- <div class="col-md-6"> --}}
                                <center>
                                <input id="password" type="password" style="width: 65%" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                </center>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            {{-- </div> --}}
                        </div>

                        <div class="row mb-3">
                            {{-- <div class="col-md-6 offset-md-4"> --}}
                                <center style="margin-left: -80px;">
                                {{-- <div class="form-check"> --}}
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                {{-- </div> --}}
                                </center>
                            {{-- </div> --}}
                        </div>

                        <div class="row mb-0">
                            {{-- <div class="col-md-8 offset-md-4"> --}}
                                <center style="margin-left: -23px;">
                                <button type="submit" class="btn btn-primary bp">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                </center>
                            {{-- </div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
