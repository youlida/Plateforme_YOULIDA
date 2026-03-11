@extends('back.layouts.app')

@section('title','Modifier utilisateur')

@section('content')

<div class="container">

<h4>Modifier utilisateur</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.utilisateurs.update',$user->id) }}" method="POST">

@csrf
@method('PUT')

<div class="mb-3">
<label>Nom</label>
<input type="text"
name="name"
value="{{ $user->name }}"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Prénom</label>
<input type="text"
name="prenom"
value="{{ $user->prenom }}"
class="form-control">
</div>

<div class="mb-3">
<label>Email</label>
<input type="email"
name="email"
value="{{ $user->email }}"
class="form-control">
</div>

<div class="mb-3">
<label>Téléphone</label>
<input type="text"
name="telephone"
value="{{ $user->telephone }}"
class="form-control">
</div>

<div class="mb-3">
<label>Pays</label>
<input type="text"
name="pays"
value="{{ $user->pays }}"
class="form-control">
</div>

<div class="mb-3">
<label>Ville</label>
<input type="text"
name="ville"
value="{{ $user->ville }}"
class="form-control">
</div>

<div class="mb-3">
<label>Rôle</label>

<select name="role_id" class="form-control">

@foreach($roles as $role)

<option value="{{ $role->id }}"
@if($user->role_id == $role->id) selected @endif>
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
{{ $user->is_active ? 'checked' : '' }}>

<label class="form-check-label">
Compte actif
</label>

</div>

<button class="btn btn-primary">
Mettre à jour
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