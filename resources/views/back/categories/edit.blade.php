@extends('back.layouts.app')

@section('title','Modifier catégorie')

@section('content')

<div class="container">

<h4>Modifier catégorie</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.categories.update',$categorie->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Nom</label>

<input type="text"
name="name"
class="form-control"
value="{{ old('name',$categorie->name) }}"
required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea name="description"
class="form-control"
rows="4">{{ old('description',$categorie->description) }}</textarea>

</div>

<div class="form-check mb-3">

<input type="checkbox"
name="is_active"
value="1"
class="form-check-input"
{{ $categorie->is_active ? 'checked' : '' }}>

<label class="form-check-label">
Activer la catégorie
</label>

</div>

<button class="btn btn-primary">
Mettre à jour
</button>

<a href="{{ route('admin.categories.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection