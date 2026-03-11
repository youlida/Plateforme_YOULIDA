@extends('back.layouts.app')

@section('title','Voir catégorie')

@section('content')

<div class="container">

<h4>Détails catégorie</h4>

<div class="card">
<div class="card-body">

<p><strong>ID :</strong> {{ $categorie->id }}</p>

<p><strong>Nom :</strong> {{ $categorie->name }}</p>

<p><strong>Slug :</strong> {{ $categorie->slug }}</p>

<p><strong>Description :</strong></p>

<p>{{ $categorie->description }}</p>

<p>

<strong>Actif :</strong>

@if($categorie->is_active)
Oui
@else
Non
@endif

</p>

<p>

<strong>Date création :</strong>
{{ $categorie->created_at->format('d/m/Y H:i') }}

</p>

</div>
</div>

<br>

<a href="{{ route('admin.categories.index') }}"
class="btn btn-secondary">
Retour

</a>

</div>

@endsection