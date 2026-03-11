<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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