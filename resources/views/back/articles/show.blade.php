@extends('back.layouts.app')

@section('title', 'Détail article')

@section('content')
<div class="container">
    <h4 class="mb-4">Détail de l'article</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <p><strong>ID :</strong> {{ $article->id }}</p>
            <p><strong>Titre :</strong> {{ $article->title }}</p>
            <p><strong>Slug :</strong> {{ $article->slug }}</p>
            <p><strong>Catégorie :</strong> {{ $article->categorie->name ?? 'Aucune' }}</p>
            <p><strong>Auteur :</strong> {{ $article->user->name ?? 'Inconnu' }}</p>

            <p>
                <strong>Image :</strong><br>
                @if($article->image)
                    <img src="{{ $article->image }}" alt="{{ $article->title }}" style="max-width: 250px;" class="img-fluid rounded border">
                @else
                    <span>Aucune image</span>
                @endif
            </p>

            <p><strong>Contenu :</strong></p>
            <div class="border rounded p-3 bg-light">
                {!! nl2br(e($article->content)) !!}
            </div>

            <p class="mt-3">
                <strong>Publié :</strong>
                @if($article->is_published)
                    <span class="badge bg-success">Oui</span>
                @else
                    <span class="badge bg-secondary">Non</span>
                @endif
            </p>

            <p><strong>Date publication :</strong> {{ $article->published_at ? $article->published_at->format('d/m/Y H:i') : '-' }}</p>
            <p><strong>Créé le :</strong> {{ $article->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Mis à jour le :</strong> {{ $article->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-warning">Modifier</a>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</div>
@endsection