@extends('back.layouts.app')

@section('title','Créer message')

@section('content')

<div class="container">

<h4>Créer un message</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.contacts.store') }}" method="POST">

@csrf

<div class="mb-3">
<label>Nom</label>

<input type="text"
name="name"
class="form-control"
value="{{ old('name') }}"
required>

</div>

<div class="mb-3">
<label>Email</label>

<input type="email"
name="email"
class="form-control"
value="{{ old('email') }}"
required>

</div>

<div class="mb-3">
<label>Sujet</label>

<input type="text"
name="subject"
class="form-control"
value="{{ old('subject') }}">

</div>

<div class="mb-3">
<label>Message</label>

<textarea name="message"
class="form-control"
rows="5"
required>{{ old('message') }}</textarea>

</div>

<div class="form-check mb-3">

<input type="checkbox"
name="is_read"
value="1"
class="form-check-input">

<label class="form-check-label">
Message lu
</label>

</div>

<button class="btn btn-success">
Enregistrer
</button>

<a href="{{ route('admin.contacts.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection