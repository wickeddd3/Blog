@extends('layouts.app')

@section('content')
<div class="container--fluid center">
    <div class="container__row center">
        <div class="container__col-xl-5 container__col-lg-5 container__col-md-7 container__col-sm-11 container__col-12">
            <div class="login">
                <div class="login__header">
                    <span class="login__title">
                        Sign In
                    </span>
                </div>
                <div class="login__body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="login__item">
                            <input type="email"
                                    class="login__input @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Email">
                            @error('email')
                                <span class="login__error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="login__item">
                            <input type="password"
                                    class="login__input @error('password') is-invalid @enderror"
                                    name="password"
                                    placeholder="Password">
                            @error('password')
                                <span class="login__error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="login__item">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="heading-secondary m-l-1">
                                Remember Me
                            </label>
                        </div>
                        <div class="login__item">
                            <button type="submit" class="btn btn-primary login__btn">Sign In</button>
                        </div>
                    </form>
                </div>
                <div class="login__footer">
                    <div class="login__item center">
                        @if (Route::has('password.request'))
                            <a class="heading-secondary" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        @endif
                    </div>
                    <div class="login__item center">
                        <a class="heading-secondary" href="/register">Create new account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
