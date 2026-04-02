<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">

    <!-- Facebook -->
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">


    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- vendor css -->

    <link href={{ asset('assets/lib/font-awesome/css/font-awesome.css') }} rel="stylesheet">
    <link href={{ asset('assets/lib/Ionicons/css/ionicons.css') }} rel="stylesheet">
    <link href={{ asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.css') }} rel="stylesheet">
    <link href={{ asset('assets/lib/rickshaw/rickshaw.min.css') }} rel="stylesheet">
    <!-- احذف أو علق على رابط Bootstrap القديم، وضع هذا مكانه -->

    <!-- Starlight CSS -->
    <link rel="stylesheet" href={{ asset('assets/css/starlight.css') }}>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/js/app.js'])
    @endif
</head>

<body>
