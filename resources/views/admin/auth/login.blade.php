@extends('admin.auth.partial.master')
@section('title')
    login
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin<span class="tx-info tx-normal"> LogIn</span>
            </div>
            <div class="tx-center mg-b-30" style="color: red"><x-redirect-message name="fail"></x-redirect-message></div>
            {{-- "email or password is not correct" --}}
            <div class="tx-center mg-b-30" style="color: green"><x-redirect-message name='password_updated'
                    color="green"></x-redirect-message></div>{{-- "your password updated" --}}

            <form action={{ route('admin.login.store') }} target="" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter your email"
                        value={{ old('email') }}>
                </div><!-- form-group -->
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter your password">
                    <br>
                    <label class="ckbox">
                        <input type="checkbox" name="remember">
                        <span>remember me</span>
                    </label>
                    <a href={{ route('admin.password.create') }} class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
                </div><!-- form-group -->
                <button type="submit" class="btn btn-info btn-block">login</button>
            </form>
            <div class="mg-t-60 tx-center">Not yet a member? <a href={{ route('admin.register.create') }}
                    class="tx-info">register</a></div>
            {{-- <div class="mg-t-20 tx-center">back to <a href="/">home</a></div> --}}
        </div><!-- login-wrapper -->
    </div><!-- d-flex -->
@endsection





{{-- <x-redirect-message name='password_updated' color="green"></x-redirect-message>
<form action={{ route('admin.login.store') }} target="" method="POST">
    @csrf
    email <input type="email" name="email" value={{ old('email') }}>
    <br><br>
    password <input type="password" name="password">
    <br><br>
    <x-redirect-message name="fail" color="red"></x-redirect-message>
    <input type="checkbox" name="remember"> remember me
    <br><br>
    <input type="submit" value="login">
</form>
<a href={{ route('admin.register.create') }}>register</a><br>
<a href={{ route('admin.password.create') }}>forget password</a> --}}
