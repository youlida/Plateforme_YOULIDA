@extends('back.layouts.app')

@section('title', 'Créer un article')

@section('content')
<div class="container">
    <h4 class="mb-4">Créer un article</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.articles.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="categorie_id" class="form-label">Catégorie</label>
                    <select name="categorie_id" id="categorie_id" class="form-control">
                        <option value="">-- Choisir une catégorie --</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('categorie_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text"
                           name="title"
                           id="title"
                           class="form-control"
                           value="{{ old('title') }}"
                           required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image (URL ou chemin)</label>
                    <input type="text"
                           name="image"
                           id="image"
                           class="form-control"
                           value="{{ old('image') }}">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Contenu</label>
                    <textarea name="content"
                              id="content"
                              rows="8"
                              class="form-control"
                              required>{{ old('content') }}</textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="published_at" class="form-label">Date de publication</label>
                    <input type="datetime-local"
                           name="published_at"
                           id="published_at"
                           class="form-control"
                           value="{{ old('published_at') }}">
                    @error('published_at')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox"
                           name="is_published"
                           id="is_published"
                           class="form-check-input"
                           value="1"
                           {{ old('is_published') ? 'checked' : '' }}>
                    <label for="is_published" class="form-check-label">
                        Publier immédiatement
                    </label>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </div>
</div>
@endsection