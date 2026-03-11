@extends('back.layouts.app')

@section('title','Voir média')

@section('content')

<div class="container">

<h4>Détails du média</h4>

<div class="card">
<div class="card-body">

<p><strong>ID :</strong> {{ $media->id }}</p>

<p><strong>Titre :</strong> {{ $media->title }}</p>

<p><strong>Type :</strong> {{ $media->type }}</p>

<p><strong>Fichier :</strong></p>

<a href="{{ $media->file_path }}" target="_blank">
{{ $media->file_path }}
</a>

<br><br>

@if(Str::contains($media->file_path,['jpg','png','jpeg','webp']))
<img src="{{ $media->file_path }}" width="200" class="rounded">
@endif

<p class="mt-3">

<strong>Date création :</strong>
{{ $media->created_at->format('d/m/Y H:i') }}

</p>

</div>
</div>

<br>

<a href="{{ route('admin.media.index') }}"
class="btn btn-secondary">
Retour
</a>

</div>

@endsection