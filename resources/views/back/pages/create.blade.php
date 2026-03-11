@extends('back.layouts.app')

@section('title','Créer page')

@section('content')

<div class="container">

<h4>Créer une page</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.pages.store') }}" method="POST">

@csrf

<div class="mb-3">
<label>Titre</label>

<input type="text"
name="title"
class="form-control"
value="{{ old('title') }}"
required>

@error('title')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="mb-3">
<label>Contenu</label>

<textarea name="content"
class="form-control"
rows="8"
required>{{ old('content') }}</textarea>

@error('content')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-check mb-3">

<input type="checkbox"
name="is_published"
value="1"
class="form-check-input">

<label class="form-check-label">
Publier la page
</label>

</div>

<button class="btn btn-success">
Enregistrer
</button>

<a href="{{ route('admin.pages.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection