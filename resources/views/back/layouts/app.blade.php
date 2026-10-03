<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Favicons YOULIDA --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">

    <link rel="shortcut icon" href="{{ asset('favicon_io/favicon.ico') }}">

    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard Admin')</title>

    @include('back.layouts.style')
</head>

<body>
    <div class="admin-wrapper">
        {{-- Sidebar --}}
        @include('back.layouts.sidebar')

        <div class="main-content">
            {{-- Header --}}
            @include('back.layouts.header')

            {{-- Topbar --}}
            @include('back.layouts.topbar')

            {{-- Page content --}}
            <main class="page-content">
                @yield('content')
            </main>
        </div>
    </div>

    @include('back.layouts.script')
</body>

</html>
