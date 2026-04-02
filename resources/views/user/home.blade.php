@extends('user.layouts.master')
@section('title')
    الرئيسية
@endsection
@section('content')
    @include('user.navbar')
    @include('user.specials-section')
    @include('user.offers-section')
    @include('user.newest-section')
    @livewire('user.login-alert')
    {{-- يعرض لطلب تسجيل دخول --}}
    <br><br><br><br>
@endsection
