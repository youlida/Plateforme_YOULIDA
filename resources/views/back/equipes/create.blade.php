@extends('back.layouts.app')

@section('title','Créer membre')

@section('content')

<div class="container">

<h4>Ajouter un membre de l’équipe</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.equipes.store') }}" method="POST">

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
<label>Rôle</label>

<input type="text"
name="role"
class="form-control"
value="{{ old('role') }}">

</div>

<div class="mb-3">
<label>Photo (URL)</label>

<input type="text"
name="photo"
class="form-control"
value="{{ old('photo') }}">

</div>

<div class="mb-3">
<label>Biographie</label>

<textarea name="bio"
class="form-control"
rows="4">{{ old('bio') }}</textarea>

</div>

<button class="btn btn-success">
Enregistrer
</button>

<a href="{{ route('admin.equipes.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection