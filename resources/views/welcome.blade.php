<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

            {{-- AJOUTEZ CES LIGNES POUR LA PAGE À PROPOS --}}
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
