@extends('back.layouts.app')

@section('title','Voir don')

@section('content')

<div class="container">

<h4>Détails du don</h4>

<div class="card">
<div class="card-body">

<p><strong>ID :</strong> {{ $don->id }}</p>

<p><strong>Donateur :</strong> {{ $don->donor_name }}</p>

<p><strong>Email :</strong> {{ $don->email }}</p>

<p><strong>Montant :</strong> {{ number_format($don->amount,2) }}</p>

<p><strong>Méthode de paiement :</strong> {{ $don->payment_method }}</p>

<p><strong>ID Transaction :</strong> {{ $don->transaction_id }}</p>

<p><strong>Message :</strong></p>

<p>{{ $don->message }}</p>

<p>

<strong>Date du don :</strong>

@if($don->donated_at)
{{ \Carbon\Carbon::parse($don->donated_at)->format('d/m/Y') }}
@endif

</p>

</div>
</div>

<br>

<a href="{{ route('admin.dons.index') }}"
class="btn btn-secondary">
Retour
</a>

</div>

@endsection