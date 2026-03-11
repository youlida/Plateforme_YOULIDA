@extends('back.layouts.app')

@section('title','Voir membre')

@section('content')

<div class="container">

<h4>Détails du membre</h4>

<div class="card">
<div class="card-body">

@if($equipe->photo)
<img src="{{ $equipe->photo }}" width="120" class="mb-3 rounded">
@endif

<p><strong>ID :</strong> {{ $equipe->id }}</p>

<p><strong>Nom :</strong> {{ $equipe->name }}</p>

<p><strong>Rôle :</strong> {{ $equipe->role }}</p>

<p><strong>Biographie :</strong></p>

<p>{{ $equipe->bio }}</p>

<p>

<strong>Date création :</strong>
{{ $equipe->created_at->format('d/m/Y H:i') }}

</p>

</div>
</div>

<br>

<a href="{{ route('admin.equipes.index') }}"
class="btn btn-secondary">
Retour
</a>

</div>

@endsection