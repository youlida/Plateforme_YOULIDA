<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Authentification')</title>

    @include('back.layouts.style')
</head>

<body style="background:#f1f5f9;">

    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="w-100" style="max-width:450px;">
            @yield('content')
        </div>
    </div>

    @include('back.layouts.script')

</body>
</html>