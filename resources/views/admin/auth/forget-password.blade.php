@extends('admin.auth.partial.master')
@section('title')
    forget-password
@endsection
@section('content')
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin<span class="tx-info tx-normal"> Forgot
                    Password</span>
            </div>
            {{-- 'try agin after 30 minutes' --}}
            {{-- <x-redirect-message name='maxAttempts' color="red"></x-redirect-message> --}}
            <div class="tx-center mg-b-30" style="color: red">
                @if (session('maxAttempts'))
                    @livewire('admin.password-cooldown-timer', ['email' => session('maxAttempts')], key(session('maxAttempts')))
                @endif
            </div>
            {{-- "we sent a new reset link check your email" --}}
            <div class="tx-center mg-b-30" style="color: green"><x-redirect-message name='new'></x-redirect-message></div>
            <form action={{ route('admin.password.store') }} target="" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter your email"
                        value={{ old('email') }}>
                    <div class="tx-center mg-b-20" style="color: red"> <x-input-error input="email"></x-input-error></div>
                </div><!-- form-group -->
                {{-- your email is not match --}}
                <div class="tx-center mg-b-30"><x-redirect-message name='notMatch'></x-redirect-message></div>
                <button type="submit" class="btn btn-info btn-block">get reset link</button>
            </form>
            <div class="mg-t-60 tx-center"><a href={{ route('admin.login.create') }}>login</a></div>
            {{-- <div class="mg-t-20 tx-center">back to <a href="/">home</a></div> --}}
        </div><!-- login-wrapper -->
    </div><!-- d-flex -->
@endsection















{{-- <div>
    @if (session('maxAttempts'))
        @livewire('admin.password-cooldown-timer', ['email' => session('maxAttempts')], key(session('maxAttempts')))
    @endif
</div>

<x-redirect-message name='new' color="green"></x-redirect-message>
<form action={{ route('admin.password.store') }} target="" method="POST">
    @csrf
    enter your email <input type="email" name="email" value={{ old('email') }}>
    <input type="submit" value="get reset link">
</form>

<x-redirect-message name='notMatch' color="yellow"></x-redirect-message>
<a href={{ route('admin.login.create') }}>login</a> --}}
