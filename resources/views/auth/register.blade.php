@extends('layouts.app')

@section('content')
<div class="container--fluid center">
    <div class="container__row center">
        <div class="container__col-xl-5 container__col-lg-5 container__col-md-7 container__col-sm-11 container__col-12">
            <div class="register">
                <div class="register__header">
                    <span class="register__title">
                        Sign Up
                    </span>
                </div>
                <div class="register__body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="register__item">
                            <input type="text"
                                    class="register__input @error('first_name') is-invalid @enderror"
                                    name="first_name"
                                    value="{{ old('first_name') }}"
                                    placeholder="First name">
                            @error('first_name')
                                <span class="register__error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="register__item">
                            <input type="text"
                                    class="register__input @error('last_name') is-invalid @enderror"
                                    name="last_name"
                                    value="{{ old('last_name') }}"
                                    placeholder="Last name">
                            @error('last_name')
                                <span class="register__error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="register__item">
                            <input type="text"
                                    class="register__input @error('username') is-invalid @enderror"
                                    name="username"
                                    value="{{ old('username') }}"
                                    placeholder="Username">
                            @error('username')
                                <span class="register__error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="register__item">
                            <input type="email"
                                    class="register__input @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Email">
                            @error('email')
                                <span class="register__error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="register__item">
                            <input type="password"
                                    class="register__input @error('password') is-invalid @enderror"
                                    name="password"
                                    value="{{ old('password') }}"
                                    placeholder="Password">
                            @error('password')
                                <span class="register__error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="register__item">
                            <input type="password" class="register__input" name="password_confirmation" placeholder="Retype password">
                        </div>
                        <div class="login__item">
                            <button type="submit" class="btn btn--primary register__btn">Sign Up</button>
                        </div>
                    </form>
                </div>
                <div class="register__footer">
                    <div class="register__item center">
                        <a class="heading-secondary" href="/login">I already have an account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
