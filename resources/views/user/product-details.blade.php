@extends('user.layouts.master')
@section('title')
    {{ $product->name }}
@endsection
@section('content')
    @switch($type)
        @case('special')
            @livewire('user.products.specials.details-page', ['user' => $user, 'product' => $product])
        @break

        @case('offer')
            @livewire('user.products.offers.details-page', ['user' => $user, 'product' => $product])
        @break

        @case('newest')
            @livewire('user.products.newest.details-page', ['user' => $user, 'product' => $product])
        @break

        @case('normal')
            @livewire('user.products.normal.details-page', ['user' => $user, 'product' => $product])
        @break

        @default
    @endswitch
    @include('user.similar-section')
    @livewire('user.login-alert')
@endsection
