@extends('layouts.login')

@section('content')
<div class="animate form login_form">
    <section class="login_content">
        <form class="login-form" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <h1>Login</h1>
            <div class="{{ $errors->has('email') ? 'has-error' : '' }}">
                <input placeholder="E-mail" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus />
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="{{ $errors->has('password') ? 'has-error' : '' }}">
                <input placeholder="Password" id="password" type="password" class="form-control" name="password" required />
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div>
                <button type="submit" class="btn btn-default submit">Log in</button>
                <a class="reset_pass" href="{{ route('password.request') }}">Lost your password?</a>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
                <p class="change_link">New to site?
                    <a href="{{ route('register') }}" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                    <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                    <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection
