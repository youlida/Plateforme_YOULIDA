@extends('back.layouts.app')

@section('title','Créer catégorie')

@section('content')

<div class="container">

<h4>Créer une catégorie</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.categories.store') }}" method="POST">

@csrf

<div class="mb-3">
<label>Nom</label>

<input type="text"
name="name"
class="form-control"
value="{{ old('name') }}"
required>

@error('name')
<small class="text-danger">{{ $message }}</small>
@enderror

</div>

<div class="mb-3">
<label>Description</label>

<textarea name="description"
class="form-control"
rows="4">{{ old('description') }}</textarea>

</div>

<div class="form-check mb-3">

<input type="checkbox"
name="is_active"
value="1"
class="form-check-input">

<label class="form-check-label">
Activer la catégorie
</label>

</div>

<button class="btn btn-success">
Enregistrer
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