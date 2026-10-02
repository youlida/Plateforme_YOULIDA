@extends('back.layouts.app')

@section('title', 'Modifier catégorie')

@section('content')
<div class="container-fluid">
    <h4>Modifier catégorie</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $categorie->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nom</label>
                    <input type="text" 
                           name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $categorie->name) }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" 
                              class="form-control @error('description') is-invalid @enderror" 
                              rows="4">{{ old('description', $categorie->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" 
                           name="is_active" 
                           id="is_active" 
                           class="form-check-input" 
                           value="1"
                           {{ old('is_active', $categorie->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Activer la catégorie
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </div>
</div>
@endsection