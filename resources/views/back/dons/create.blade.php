@extends('back.layouts.app')

@section('title','Créer don')

@section('content')

<div class="container">

<h4>Enregistrer un don</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.dons.store') }}" method="POST">

@csrf

<div class="mb-3">
<label>Nom du donateur</label>

<input type="text"
name="donor_name"
class="form-control"
value="{{ old('donor_name') }}"
required>
</div>

<div class="mb-3">
<label>Email</label>

<input type="email"
name="email"
class="form-control"
value="{{ old('email') }}">
</div>

<div class="mb-3">
<label>Montant</label>

<input type="number"
name="amount"
step="0.01"
class="form-control"
value="{{ old('amount') }}"
required>
</div>

<div class="mb-3">
<label>Méthode de paiement</label>

<input type="text"
name="payment_method"
class="form-control"
value="{{ old('payment_method') }}">
</div>

<div class="mb-3">
<label>ID Transaction</label>

<input type="text"
name="transaction_id"
class="form-control"
value="{{ old('transaction_id') }}">
</div>

<div class="mb-3">
<label>Message</label>

<textarea name="message"
class="form-control"
rows="4">{{ old('message') }}</textarea>
</div>

<div class="mb-3">
<label>Date du don</label>

<input type="date"
name="donated_at"
class="form-control"
value="{{ old('donated_at') }}">
</div>

<button class="btn btn-success">
Enregistrer
</button>

<a href="{{ route('admin.dons.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection