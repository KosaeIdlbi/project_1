@extends('user.layouts.master')
@section('title')
    الرئيسية
@endsection
@section('content')
    @livewire('user.products.fav.view-fav', ['user' => $user])
@endsection
