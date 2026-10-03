<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Favicons YOULIDA --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">

    <link rel="shortcut icon" href="{{ asset('favicon_io/favicon.ico') }}">

    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
    <title>Youlida</title>
    @viteReactRefresh
    @vite('resources/js/app.jsx')

    {{-- Injection des données Laravel --}}
    <script>
        window.LaravelData = {
            @if(isset($articles)) articles: @json($articles), @endif
            @if(isset($programmes)) programmes: @json($programmes), @endif
                @if(isset($temoignages)) temoignages: @json($temoignages), @endif
                    @if(isset($partenaires)) partenaires: @json($partenaires), @endif
                        @if(isset($equipe)) equipe: @json($equipe), @endif
                            @if(isset($categories)) categories: @json($categories), @endif
                                @if(isset($page)) page: @json($page), @endif
                                    @if(isset($article)) article: @json($article), @endif
                                        @if(isset($articlesRecents)) articlesRecents: @json($articlesRecents), @endif
                                            @if(isset($programme)) programme: @json($programme), @endif


                                                @if(isset($about))
                                                    about: @json($about),
                                                @endif

            route: "{{ Route::currentRouteName() }}"
        };
    </script>
</head>

<body>
    <div id="react-app"></div>
</body>

</html>
