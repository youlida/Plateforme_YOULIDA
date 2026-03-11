@extends('back.layouts.app')

@section('title','Voir témoignage')

@section('content')

<div class="container">

<h4>Détails du témoignage</h4>

<div class="card">
<div class="card-body">

<p><strong>ID :</strong> {{ $temoignage->id }}</p>

<p><strong>Nom :</strong> {{ $temoignage->name }}</p>

<p><strong>Email :</strong> {{ $temoignage->email }}</p>

<p>
<strong>Photo :</strong>
@if($temoignage->photo)
<br>
<img src="{{ $temoignage->photo }}" width="120">
@endif
</p>

<p>
<strong>Message :</strong>
</p>

<p>{{ $temoignage->message }}</p>

<p>
<strong>Publié :</strong>

@if($temoignage->is_published)
<span class="badge bg-success">Oui</span>
@else
<span class="badge bg-danger">Non</span>
@endif
</p>

</div>
</div>

<br>

<a href="{{ route('admin.temoignages.index') }}"
class="btn btn-secondary">
Retour
</a>

</div>

@endsection