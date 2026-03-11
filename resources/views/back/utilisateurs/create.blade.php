@extends('back.layouts.app')

@section('title','Créer utilisateur')

@section('content')

<div class="container">

<h4>Créer un utilisateur</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.utilisateurs.store') }}" method="POST">

@csrf

<div class="mb-3">
<label>Nom</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Prénom</label>
<input type="text" name="prenom" class="form-control">
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Téléphone</label>
<input type="text" name="telephone" class="form-control">
</div>

<div class="mb-3">
<label>Pays</label>
<input type="text" name="pays" class="form-control">
</div>

<div class="mb-3">
<label>Ville</label>
<input type="text" name="ville" class="form-control">
</div>

<div class="mb-3">
<label>Mot de passe</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label>Rôle</label>

<select name="role_id" class="form-control">

@foreach($roles as $role)

<option value="{{ $role->id }}">
{{ $role->name }}
</option>

@endforeach

</select>

</div>

<div class="form-check mb-3">

<input type="checkbox"
name="is_active"
value="1"
class="form-check-input"
checked>

<label class="form-check-label">
Compte actif
</label>

</div>

<button class="btn btn-success">
Enregistrer
</button>

<a href="{{ route('admin.utilisateurs.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection