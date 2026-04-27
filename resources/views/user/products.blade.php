@extends('user.layouts.master')
@section('title')
    المنتجات
@endsection
@section('content')
    @livewire('user.products.view-products', ['user' => $user, 'ProductName' => $ProductName, 'CatigoryName' => $CatigoryName, 'BrandName' => $BrandName, 'TagName' => $TagName, 'Newests' => $Newests, 'Offers' => $Offers, 'Special' => $Special])
    @livewire('user.login-alert')
@endsection
