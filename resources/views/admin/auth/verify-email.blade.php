@extends('admin.auth.partial.master')
@section('title')
    verify-email
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin<span class="tx-info tx-normal"> Verify
                    Email</span>
            </div>
            <div class="tx-center mg-b-50">you are not verified yet check you email</div>

            {{-- "we sent a new verify link check your email" --}}
            <div class="tx-center mg-b-30" style="color: green">
                <x-redirect-message name='new' color="green"></x-redirect-message>
            </div>

            {{-- your verified link is incorrect or expired --}}
            <div class="tx-center mg-b-30" style="color: red"><x-redirect-message name='unverified'></x-redirect-message>
            </div>

            {{-- 'try agin after 30 minutes' --}}
            <div class="tx-center mg-b-30" style="color: red">
                @if (session('maxAttempts'))
                    @livewire('admin.verification-cooldown-timer', [], key(session('maxAttempts')))
                @endif
            </div>

            <form action={{ route('admin.verify.update') }} target="" method="POST">
                @csrf
                @method('patch')
                <div class="tx-center mg-b-30"><x-redirect-message name='notMatch'></x-redirect-message></div>
                <button type="submit" class="btn btn-info btn-block">resend verify link</button>
            </form>
            <br>
            <form action={{ route('admin.logout') }} target="" method="POST">
                @csrf
                <input class="btn btn-outline-primary btn-block mg-b-10" type="submit" value="LogOut">
            </form>
        </div><!-- login-wrapper -->
    </div><!-- d-flex -->
@endsection






{{-- 
    <h2> you are not verified yet check you email</h2>
    <x-redirect-message name='unverified' color="red"></x-redirect-message>
    <x-redirect-message name='new' color="green"></x-redirect-message>
    @if (session('maxAttempts'))
        @livewire('admin.verification-cooldown-timer', ['email' => session('maxAttempts')], key(session('maxAttempts')))
    @endif
    <form action={{ route('admin.verify.update') }} target="" method="POST">
        @csrf
        @method('patch')
        enter your email <input type="email" name="email" value={{ old('email') }}>
        <input type="submit" value="resend verify link">
    </form>
    <x-redirect-message name='notMatch' color="yellow"></x-redirect-message> --}}
