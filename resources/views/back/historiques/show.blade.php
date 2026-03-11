@extends('back.layouts.app')

@section('title','Détail historique')

@section('content')

<div class="container">

<h4>Détails de l'historique</h4>

<div class="card">
<div class="card-body">

<p>
<strong>ID :</strong>
{{ $historique->id }}
</p>

<p>
<strong>Utilisateur :</strong>
@if($historique->user)
{{ $historique->user->name }}
@else
—
@endif
</p>

<p>
<strong>Action :</strong>
{{ $historique->action }}
</p>

<p>
<strong>Description :</strong>
</p>

<p>
{{ $historique->description }}
</p>

<p>
<strong>Date :</strong>
{{ $historique->created_at->format('d/m/Y H:i') }}
</p>

</div>
</div>

<br>

<a href="{{ route('admin.historiques.index') }}"
class="btn btn-secondary">
Retour
</a>

</div>

@endsection