@extends('back.layouts.app')

@section('title','Voir programme')

@section('content')

<div class="container">

<h4>Détails du programme</h4>

<div class="card">
<div class="card-body">

@if($programme->image)
<img src="{{ $programme->image }}" width="200" class="mb-3 rounded">
@endif

<p><strong>ID :</strong> {{ $programme->id }}</p>

<p><strong>Titre :</strong> {{ $programme->title }}</p>

<p><strong>Slug :</strong> {{ $programme->slug }}</p>

<p><strong>Lieu :</strong> {{ $programme->location }}</p>

<p><strong>Date début :</strong> {{ $programme->start_date }}</p>

<p><strong>Date fin :</strong> {{ $programme->end_date }}</p>

<p><strong>Description courte :</strong></p>

<p>{{ $programme->short_description }}</p>

<p><strong>Description :</strong></p>

<p>{{ $programme->description }}</p>

<p>
<strong>Actif :</strong>

@if($programme->is_active)
Oui
@else
Non
@endif
</p>

</div>
</div>

<br>

<a href="{{ route('admin.programmes.index') }}"
class="btn btn-secondary">
Retour
</a>

</div>

@endsection