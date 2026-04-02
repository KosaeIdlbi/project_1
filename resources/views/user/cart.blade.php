@extends('user.layouts.master')
@section('title')
    سلة المشتريات
@endsection
@section('content')
    <br><br>
    @livewire('user.products.cart.view-cart', ['user' => $user])
@endsection
