@extends('layouts.app')

@section('content')
<div class="container--fluid">
    <div class="container__row center">
        <div class="container__col-xl-5 container__col-lg-5 container__col-md-7 container__col-sm-11 container__col-12">
            <div class="reset">
                <div class="reset__header">
                    <span class="login__title">
                        Reset Password
                    </span>
                </div>
                <div class="reset__body">
                    @if (session('status'))
                        <div class="reset__success m-b-1" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="reset__item">
                            <label for="email" class="reset__label">E-Mail Address</label>
                            <input id="email"
                                        type="email"
                                        class="reset__input @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ old('email') }}"

                                        autocomplete="email"
                                        autofocus>
                            @error('email')
                                <span class="reset__error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="reset__item">
                            <button type="submit" class="btn btn--primary reset__btn">Send Password Reset Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
