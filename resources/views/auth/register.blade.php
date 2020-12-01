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
{{-- <div class="container pt-4 pb-4">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Sign up</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    name="first_name"
                                    value="{{ old('first_name') }}"
                                    placeholder="First name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name"
                                    value="{{ old('last_name') }}"
                                    placeholder="Last name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text"
                                    class="form-control @error('username') is-invalid @enderror"
                                    name="username"
                                    value="{{ old('username') }}"
                                    placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    value="{{ old('password') }}"
                                    placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                    <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <div class="social-auth-links text-center">
                        <p>- OR -</p>
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i>
                            Sign up using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i>
                            Sign up using Google+
                        </a>
                    </div>

                    <a href="/login" class="text-center">I already have an account</a>
                </div>
            </div><!-- /.card -->

        </div>
    </div>
</div> --}}
@endsection
