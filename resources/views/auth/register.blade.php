@extends('layouts.app')

@section('content')




    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-6">

                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <h2>Please Register</h2>
                    <hr>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Name</label>
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>
                        <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
        </div>
    </div>
</div>
@endsection
