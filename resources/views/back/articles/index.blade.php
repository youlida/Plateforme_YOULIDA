@extends('back.layouts.app')

@section('title', 'Articles')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Liste des articles</h4>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Nouvel article
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Auteur</th>
                        <th>Publié</th>
                        <th>Date publication</th>
                        <th>Créé le</th>
                        <th width="220">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->categorie->name ?? 'Aucune' }}</td>
                            <td>{{ $article->user->name ?? 'Inconnu' }}</td>
                            <td>
                                @if($article->is_published)
                                    <span class="badge bg-success">Oui</span>
                                @else
                                    <span class="badge bg-secondary">Non</span>
                                @endif
                            </td>
                            <td>
                                {{ $article->published_at ? $article->published_at->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td>{{ $article->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.articles.show', $article->id) }}" class="btn btn-info btn-sm">
                                    Voir
                                </a>

                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-warning btn-sm">
                                    Modifier
                                </a>

                                <form action="{{ route('admin.articles.destroy', $article->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Voulez-vous vraiment supprimer cet article ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Aucun article trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection