@extends('user.layouts.master')
@section('title')
    الأقسام
@endsection
@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5 text-dark">تصفح الأقسام</h2>
            <p class="text-muted">اختر القسم الذي تود التسوق منه</p>
        </div>

        <!-- شبكة الأقسام -->
        <div class="row g-4">

            @foreach ($catigories as $catigory)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href={{ route('user.ViewProducts', [
                        'CatigoryName' => $catigory->name,
                        'BrandName' => 'all',
                        'ProductName' => 'none',
                        'TagName' => 'all',
                        'Newests' => 'none',
                        'Offers' => 'none',
                        'Special' => 'none',
                    ]) }}
                        class="">
                        <div class="category-card">
                            <div class="category-img-wrapper">
                                @if ($catigory->img != null)
                                    <img src={{ asset('catigories/imgs/' . $catigory->img->path) }} class="category-img">
                                @endif
                            </div>
                            <div class="category-name">
                                <div class="category-title-text">{{ $catigory->name }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
@endsection
