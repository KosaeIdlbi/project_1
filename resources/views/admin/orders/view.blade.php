@extends('admin.layouts.master')
@section('title')
    طلبات الزبائن
@endsection
@section('content')
    @livewire('admin.orders.view-orders', ['admin' => $admin])
@endsection
