@extends('user.layouts.master')
@section('title')
    ملفي الشخصي
@endsection
@section('content')
    <style>
        .balance-amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
            /* لون أخضر للرصيد */
        }
    </style>
    @livewire('user.profile', ['user' => $user])
@endsection
