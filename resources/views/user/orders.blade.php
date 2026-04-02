@extends('user.layouts.master')
@section('title')
    طلباتي
@endsection
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h4 class="fw-bold mb-4">طلباتي</h4>

                @livewire('user.orders.view-order', ['user' => $user])

            </div>
        </div>
    </div>
@endsection
