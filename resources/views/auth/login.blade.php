@extends('layouts.app')

@section('content')

<div class="container">

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row justify-content-md-center">
        <div class="col-lg-6">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <h2>Please Login</h2>
                <hr>

                <div class="form-group">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>

                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>

            </form>
        </div>
    </div>
</div>
@endsection
