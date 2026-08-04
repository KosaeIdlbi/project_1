@extends('user.layouts.master')
@section('title')
    الماركات
@endsection
@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5 text-dark">تصفح الماركات</h2>
            <p class="text-muted">اختر الماركة التي تود التسوق منها</p>
        </div>

        <!-- شبكة الأقسام -->
        <div class="row g-4">

            @foreach ($brands as $brand)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href={{ route('user.ViewProducts', [
                        'BrandName' => $brand->name,
                        'CatigoryName' => 'all',
                        'ProductName' => 'none',
                        'TagName' => 'all',
                        'Newests' => 'none',
                        'Offers' => 'none',
                        'Special' => 'none',
                    ]) }}
                        class="">
                        <div class="category-card">
                            <div class="category-img-wrapper">
                                @if ($brand->img != null)
                                    <img src={{ asset('brands/imgs/' . $brand->img->path) }} class="category-img">
                                @endif
                            </div>
                            <div class="category-name">
                                <div class="category-title-text">{{ $brand->name }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
@endsection
