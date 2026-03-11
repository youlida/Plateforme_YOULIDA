@extends('back.layouts.app')

@section('title','Voir message')

@section('content')

<div class="container">

<h4>Détails du message</h4>

<div class="card">
<div class="card-body">

<p><strong>ID :</strong> {{ $contact->id }}</p>

<p><strong>Nom :</strong> {{ $contact->name }}</p>

<p><strong>Email :</strong> {{ $contact->email }}</p>

<p><strong>Sujet :</strong> {{ $contact->subject }}</p>

<p><strong>Message :</strong></p>

<div class="border p-3 bg-light">
{{ $contact->message }}
</div>

<p class="mt-3">

<strong>Lu :</strong>

@if($contact->is_read)
Oui
@else
Non
@endif

</p>

<p>

<strong>Date :</strong>
{{ $contact->created_at->format('d/m/Y H:i') }}

</p>

</div>
</div>

<br>

<a href="{{ route('admin.contacts.index') }}"
class="btn btn-secondary">
Retour
</a>

</div>

@endsection