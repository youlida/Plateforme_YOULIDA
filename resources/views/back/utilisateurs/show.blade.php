@extends('back.layouts.app')

@section('title','Voir utilisateur')

@section('content')

<div class="container">

<h4>Détails utilisateur</h4>

<div class="card">
<div class="card-body">

<p><strong>ID :</strong> {{ $user->id }}</p>

<p><strong>Nom :</strong> {{ $user->name }}</p>

<p><strong>Prénom :</strong> {{ $user->prenom }}</p>

<p><strong>Email :</strong> {{ $user->email }}</p>

<p><strong>Téléphone :</strong> {{ $user->telephone }}</p>

<p><strong>Pays :</strong> {{ $user->pays }}</p>

<p><strong>Ville :</strong> {{ $user->ville }}</p>

<p><strong>Rôle :</strong>
@if($user->role)
{{ $user->role->name }}
@endif
</p>

<p><strong>Compte actif :</strong>

@if($user->is_active)
<span class="badge bg-success">Oui</span>
@else
<span class="badge bg-danger">Non</span>
@endif

</p>

</div>
</div>

<br>

<a href="{{ route('admin.utilisateurs.index') }}"
class="btn btn-secondary">
Retour
</a>

</div>

@endsection