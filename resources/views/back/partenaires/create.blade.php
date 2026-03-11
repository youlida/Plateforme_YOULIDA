@extends('back.layouts.app')

@section('title','Créer partenaire')

@section('content')

<div class="container">

<h4>Créer un partenaire</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.partenaires.store') }}" method="POST">

@csrf

<div class="mb-3">
<label>Nom</label>

<input type="text"
name="name"
class="form-control"
value="{{ old('name') }}"
required>
</div>

<div class="mb-3">
<label>Logo (URL)</label>

<input type="text"
name="logo"
class="form-control"
value="{{ old('logo') }}">
</div>

<div class="mb-3">
<label>Site web</label>

<input type="text"
name="website"
class="form-control"
value="{{ old('website') }}">
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
Activer partenaire
</label>

</div>

<button class="btn btn-success">
Enregistrer
</button>

<a href="{{ route('admin.partenaires.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection