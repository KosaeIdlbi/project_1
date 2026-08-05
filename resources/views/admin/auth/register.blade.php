@extends('admin.auth.partial.master')
@section('title')
    register
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-md-100v">

        <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin<span class="tx-info tx-normal"> SignUp</span>
            </div>
            <form action={{ route('admin.register.store') }} target="" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                        placeholder="Enter your username">
                    <div class="tx-center mg-b-20" style="color: red"> <x-input-error input="name"></x-input-error></div>

                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                        placeholder="Enter your email">
                    <div class="tx-center mg-b-20" style="color: red"> <x-input-error input="email"></x-input-error></div>

                    <input type="password" name="password" class="form-control" placeholder="Enter your password">
                    <div class="tx-center mg-b-20" style="color: red"> <x-input-error input="password"></x-input-error>
                    </div>

                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Confirm your password">
                    <br>
                    <input type="password" name="register_password" class="form-control"
                        placeholder="Enter register password">
                    <div class="tx-center mg-b-20" style="color: red"> <x-input-error
                            input="register_password"></x-input-error></div>
                </div>

                <div class="form-group tx-12">By clicking the Sign Up button below, you agreed to our privacy policy and
                    terms
                    of use of our website.</div>
                <button type="submit" class="btn btn-info btn-block">Register</button>
            </form>
            <div class="mg-t-40 tx-center">Already have an account? <a href={{ route('admin.login.create') }}
                    class="tx-info">login</a>
            </div>
            {{-- <div class="mg-t-20 tx-center">back to <a href="/">home</a></div> --}}
        </div><!-- login-wrapper -->
    </div><!-- d-flex -->
@endsection
















{{-- 
    <form action={{ route('admin.register.store') }} target="" method="POST">
        @csrf
        username <input type="text" name="name" value={{ old('name') }}>
        <br><br><x-input-error input="name"></x-input-error>

        email <input type="email" name="email" value={{ old('email') }}>
        <br><br><x-input-error input="email"></x-input-error>

        password <input type="password" name="password">
        <br><br><x-input-error input="password"></x-input-error>

        confirm password <input type="password" name="password_confirmation">
        <br><br>
        <input type="submit" value="register">
    </form>
    <a href={{ route('admin.login.create') }}>login</a> --}}
