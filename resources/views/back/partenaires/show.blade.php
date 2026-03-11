@extends('back.layouts.app')

@section('title','Voir partenaire')

@section('content')

<div class="container">

<h4>Détails du partenaire</h4>

<div class="card">
<div class="card-body">

@if($partenaire->logo)
<img src="{{ $partenaire->logo }}" width="120" class="mb-3 rounded">
@endif

<p><strong>ID :</strong> {{ $partenaire->id }}</p>

<p><strong>Nom :</strong> {{ $partenaire->name }}</p>

<p>
<strong>Site web :</strong>

@if($partenaire->website)
<a href="{{ $partenaire->website }}" target="_blank">
{{ $partenaire->website }}
</a>
@endif

</p>

<p><strong>Description :</strong></p>

<p>{{ $partenaire->description }}</p>

<p>
<strong>Actif :</strong>

@if($partenaire->is_active)
Oui
@else
Non
@endif
</p>

<p>
<strong>Date création :</strong>
{{ $partenaire->created_at->format('d/m/Y H:i') }}
</p>

</div>
</div>

<br>

<a href="{{ route('admin.partenaires.index') }}"
class="btn btn-secondary">
Retour
</a>

</div>

@endsection