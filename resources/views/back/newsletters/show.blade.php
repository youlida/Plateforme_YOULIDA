@extends('back.layouts.app')

@section('title','Voir abonné')

@section('content')

<div class="container">

    <h4>Détails Abonné</h4>

    <div class="card">
        <div class="card-body">

            <p><strong>ID :</strong> {{ $abonneNewsletter->id }}</p>

            <p><strong>Email :</strong> {{ $abonneNewsletter->email }}</p>

            <p>
                <strong>Actif :</strong>

                @if($abonneNewsletter->is_active)
                    Oui
                @else
                    Non
                @endif
            </p>

            <p><strong>Date :</strong>
                {{ $abonneNewsletter->created_at->format('d/m/Y') }}
            </p>

        </div>
    </div>

    <br>

    <a href="{{ route('admin.newsletters.index') }}" class="btn btn-secondary">
        Retour
    </a>

</div>

@endsection