@extends('admin.auth.partial.master')
@section('title')
    reset-password
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-md-100v">

        <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin<span class="tx-info tx-normal"> Reset
                    Password</span>
            </div>
            <form action={{ route('admin.password.update', ['token' => $token]) }} target="" method="POST">
                @csrf
                @method('patch')
                <div class="form-group">

                    <input type="password" name="password" class="form-control" placeholder="Enter your password">
                    <div class="tx-center mg-b-20" style="color: red"> <x-input-error input="password"></x-input-error>
                    </div>

                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Confirm your password">
                </div>
                <button type="submit" class="btn btn-info btn-block">update</button>
            </form>
            {{-- <div class="mg-t-20 tx-center">back to <a href="/">home</a></div> --}}
        </div><!-- login-wrapper -->
    </div><!-- d-flex -->
@endsection


{{-- <form action={{ route('admin.password.update', ['token' => $token]) }} target="" method="POST">
    @csrf
    @method('patch')
    new password <input type="password" name="password">
    <br><br><x-input-error input="password"></x-input-error>
    confirm password <input type="password" name="password_confirmation">
    <br><br>
    <input type="submit" value="update">
</form> --}}
