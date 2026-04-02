@extends('admin.layouts.master')
@section('title')
    شحن الأرصدة
@endsection
@section('content')
    @livewire('admin.charger.view-request', ['admin' => $admin])
@endsection
