@extends('back.layouts.app')

@section('title','Voir rapport')

@section('content')

<div class="container">

<h4>Détails du rapport</h4>

<div class="card">
<div class="card-body">

<p><strong>ID :</strong> {{ $rapport->id }}</p>

<p><strong>Titre :</strong> {{ $rapport->title }}</p>

<p><strong>Description :</strong></p>

<p>{{ $rapport->description }}</p>

<p>
<strong>Date rapport :</strong>
{{ $rapport->report_date }}
</p>

<p>
<strong>Fichier :</strong>

@if($rapport->file)
<a href="{{ $rapport->file }}" target="_blank">
Télécharger rapport
</a>
@endif
</p>

</div>
</div>

<br>

<a href="{{ route('admin.rapports.index') }}"
class="btn btn-secondary">
Retour
</a>

</div>

@endsection