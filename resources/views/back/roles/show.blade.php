@extends('back.layouts.app')

@section('title','Voir rôle')

@section('content')

<div class="container">

<h4>Détails du rôle</h4>

<div class="card">
<div class="card-body">

<p><strong>ID :</strong> {{ $role->id }}</p>

<p><strong>Nom :</strong> {{ $role->name }}</p>

<p><strong>Slug :</strong> {{ $role->slug }}</p>

<p><strong>Description :</strong></p>

<p>{{ $role->description }}</p>

<p>
<strong>Date création :</strong>
{{ $role->created_at->format('d/m/Y H:i') }}
</p>

</div>
</div>

<br>

<a href="{{ route('admin.roles.index') }}"
class="btn btn-secondary">
Retour
</a>

</div>

@endsection