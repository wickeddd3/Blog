@extends('layouts.app')

@section('content')
<div class="container--fluid">
    <div class="container__row center">
        <div class="container__col-xl-5 container__col-lg-5 container__col-md-7 container__col-sm-11 container__col-12">
            <div class="reset">
                <div class="reset__header">
                    <span class="login__title">
                        Verify your E-Mail Address
                    </span>
                </div>
                <div class="reset__body">
                    @if (session('resent'))
                        <div class="reset__success m-b-1" role="alert">
                            <p class="paragraph">A fresh verification link has been sent to your email address.</p>
                        </div>
                    @endif
                    <p class="paragraph m-b-1">Before proceeding, please check your email for a verification link.</p>
                    <p class="paragraph m-b-1">If you did not receive the email</p>
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn--primary reset__btn">Click here to request another</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
