@extends('layouts.login')

@section('content')
<div id="register" class="animate form registration_form">
    <section class="login_content">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <h1>Create Account</h1>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div>
                    <input placeholder="Name" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div>
                    <input placeholder="E-mail" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div>
                    <input placeholder="Password" id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div>
                    <input placeholder="Repeat password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-default submit">
                        Register
                    </button>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
                <p class="change_link">Already a member ?
                    <a href="{{ route('login') }}" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />
            </div>
        </form>
    </section>
</div>
@endsection
