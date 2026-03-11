@extends('back.layouts.app')

@section('title','Voir page')

@section('content')

<div class="container">

<h4>Détails de la page</h4>

<div class="card">
<div class="card-body">

<p><strong>ID :</strong> {{ $page->id }}</p>

<p><strong>Titre :</strong> {{ $page->title }}</p>

<p><strong>Slug :</strong> {{ $page->slug }}</p>

<p>
<strong>Publié :</strong>

@if($page->is_published)
Oui
@else
Non
@endif
</p>

<p><strong>Contenu :</strong></p>

<div class="border p-3">
{!! nl2br(e($page->content)) !!}
</div>

<p class="mt-3">

<strong>Date création :</strong>
{{ $page->created_at->format('d/m/Y H:i') }}

</p>

</div>
</div>

<br>

<a href="{{ route('admin.pages.index') }}"
class="btn btn-secondary">
Retour
</a>

</div>

@endsection