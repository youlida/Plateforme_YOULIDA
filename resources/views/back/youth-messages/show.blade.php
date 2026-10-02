@extends('back.layouts.app')

@section('title', 'Demande ' . $youthMessage->reference)

@section('content')

<div class="container-fluid">

    {{-- En-tête --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <a
                href="{{ route('admin.youth-messages.index') }}"
                class="text-decoration-none"
            >
                ← Retour aux messages
            </a>

            <h1 class="h3 mt-2 mb-1">
                {{ $youthMessage->reference }}
            </h1>

            <p class="text-muted mb-0">
                Reçu le
                {{ $youthMessage->created_at->format('d/m/Y') }}
                à
                {{ $youthMessage->created_at->format('H:i') }}
            </p>
        </div>

        <div>
            @switch($youthMessage->status)

                @case('nouveau')
                    <span class="badge bg-danger fs-6">
                        Nouveau
                    </span>
                    @break

                @case('en_cours')
                    <span class="badge bg-primary fs-6">
                        En cours
                    </span>
                    @break

                @case('en_attente')
                    <span class="badge bg-warning text-dark fs-6">
                        En attente
                    </span>
                    @break

                @case('traite')
                    <span class="badge bg-success fs-6">
                        Traité
                    </span>
                    @break

                @case('clos')
                    <span class="badge bg-secondary fs-6">
                        Clos
                    </span>
                    @break

            @endswitch
        </div>

    </div>


    {{-- Succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Erreurs --}}
    @if($errors->any())
        <div class="alert alert-danger">

            <strong>
                Certaines informations sont incorrectes :
            </strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


    <div class="row g-4">

        {{-- ================================================= --}}
        {{-- COLONNE GAUCHE : MESSAGE DU JEUNE --}}
        {{-- ================================================= --}}

        <div class="col-lg-7">

            {{-- Message --}}
            <div class="card shadow-sm mb-4">

                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        Message reçu
                    </h5>
                </div>

                <div class="card-body">

                    @if($youthMessage->message)

                        <div
                            class="p-3 bg-light rounded"
                            style="white-space: pre-wrap;"
                        >{{ $youthMessage->message }}</div>

                    @else

                        <p class="text-muted mb-0">
                            Aucun message écrit.
                        </p>

                    @endif

                </div>

            </div>


            {{-- Message vocal --}}
            @if($youthMessage->audio_path)

                <div class="card shadow-sm mb-4">

                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            🎙️ Message vocal
                        </h5>
                    </div>

                    <div class="card-body">

                        <audio
                            controls
                            preload="metadata"
                            class="w-100"
                        >
                            <source
    src="{{ route('admin.youth-messages.audio', $youthMessage) }}"
>

                            Votre navigateur ne prend pas en charge
                            la lecture audio.
                        </audio>

                    </div>

                </div>

            @endif


            {{-- Informations --}}
            <div class="card shadow-sm mb-4">

                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        Informations de la demande
                    </h5>
                </div>

                <div class="card-body">

                    <div class="row g-4">

                        {{-- Catégorie --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Catégorie
                            </small>

                            <strong>
                                @switch($youthMessage->category)

                                    @case('ecole')
                                        École / études
                                        @break

                                    @case('famille')
                                        Famille
                                        @break

                                    @case('relations')
                                        Relations / amitiés
                                        @break

                                    @case('bien-etre')
                                        Santé / bien-être
                                        @break

                                    @case('sante-sexuelle')
                                        Santé sexuelle
                                        @break

                                    @case('violence')
                                        Violence / harcèlement
                                        @break

                                    @case('substances')
                                        Drogues / substances
                                        @break

                                    @case('orientation')
                                        Orientation / avenir
                                        @break

                                    @case('autre')
                                        Autre
                                        @break

                                    @case('non-precise')
                                        Préfère ne pas préciser
                                        @break

                                    @default
                                        Non précisé

                                @endswitch
                            </strong>

                        </div>


                        {{-- Canal source --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Canal d'origine
                            </small>

                            <strong>
                                {{ strtoupper($youthMessage->source_channel) }}
                            </strong>

                        </div>


                        {{-- Rappel --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Demande de rappel
                            </small>

                            @if($youthMessage->wants_callback)

                                <span class="badge bg-warning text-dark">
                                    Oui
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Non
                                </span>

                            @endif

                        </div>


                        {{-- Qualification --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Qualification actuelle
                            </small>

                            <strong>
                                {{ $youthMessage->qualification ?? 'Non qualifiée' }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Informations de rappel --}}
            @if($youthMessage->wants_callback)

                <div class="card shadow-sm border-warning mb-4">

                    <div class="card-header bg-warning bg-opacity-10">

                        <h5 class="mb-0">
                            📞 Rappel demandé
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="row g-4">

                            <div class="col-md-4">

                                <small class="text-muted d-block">
                                    Canal
                                </small>

                                <strong>
                                    {{ ucfirst($youthMessage->callback_channel) }}
                                </strong>

                            </div>


                            <div class="col-md-4">

                                <small class="text-muted d-block">
                                    Contact
                                </small>

                                <strong>
                                    {{ $youthMessage->contact }}
                                </strong>

                            </div>


                            <div class="col-md-4">

                                <small class="text-muted d-block">
                                    Moment souhaité
                                </small>

                                <strong>
                                    @switch($youthMessage->callback_time)

                                        @case('matin')
                                            Matin
                                            @break

                                        @case('apres-midi')
                                            Après-midi
                                            @break

                                        @case('soir')
                                            Soir
                                            @break

                                        @case('indifferent')
                                            Indifférent
                                            @break

                                        @default
                                            Non précisé

                                    @endswitch
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            @endif

        </div>


        {{-- ================================================= --}}
        {{-- COLONNE DROITE : TRAITEMENT INTERNE --}}
        {{-- ================================================= --}}

        <div class="col-lg-5">

            <div class="card shadow-sm">

                <div class="card-header bg-white">

                    <h5 class="mb-1">
                        Traitement interne
                    </h5>

                    <small class="text-muted">
                        Informations réservées à l'équipe YOULIDA.
                    </small>

                </div>


                <div class="card-body">

                    <form
                        method="POST"
                        action="{{ route(
                            'admin.youth-messages.update',
                            $youthMessage
                        ) }}"
                    >

                        @csrf
                        @method('PUT')


                        {{-- Qualification --}}
                        <div class="mb-3">

                            <label
                                for="qualification"
                                class="form-label fw-semibold"
                            >
                                Qualification
                            </label>

                            <select
                                id="qualification"
                                name="qualification"
                                class="form-select"
                            >

                                <option value="">
                                    Non qualifiée
                                </option>

                                <option
                                    value="A"
                                    @selected(
                                        old(
                                            'qualification',
                                            $youthMessage->qualification
                                        ) === 'A'
                                    )
                                >
                                    A
                                </option>

                                <option
                                    value="B"
                                    @selected(
                                        old(
                                            'qualification',
                                            $youthMessage->qualification
                                        ) === 'B'
                                    )
                                >
                                    B
                                </option>

                                <option
                                    value="C"
                                    @selected(
                                        old(
                                            'qualification',
                                            $youthMessage->qualification
                                        ) === 'C'
                                    )
                                >
                                    C
                                </option>

                                <option
                                    value="D"
                                    @selected(
                                        old(
                                            'qualification',
                                            $youthMessage->qualification
                                        ) === 'D'
                                    )
                                >
                                    D
                                </option>

                            </select>

                        </div>


                        {{-- Responsable --}}
                        <div class="mb-3">

                            <label
                                for="assigned_to"
                                class="form-label fw-semibold"
                            >
                                Responsable
                            </label>

                            <select
                                id="assigned_to"
                                name="assigned_to"
                                class="form-select"
                            >

                                <option value="">
                                    Aucun responsable
                                </option>

                                @foreach($users as $user)

                                    <option
                                        value="{{ $user->id }}"
                                        @selected(
                                            (string) old(
                                                'assigned_to',
                                                $youthMessage->assigned_to
                                            ) === (string) $user->id
                                        )
                                    >
                                        {{ $user->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Résumé interne --}}
                        <div class="mb-3">

                            <label
                                for="internal_summary"
                                class="form-label fw-semibold"
                            >
                                Résumé interne
                            </label>

                            <textarea
                                id="internal_summary"
                                name="internal_summary"
                                rows="4"
                                class="form-control"
                                placeholder="Résumé factuel de la situation..."
                            >{{ old(
                                'internal_summary',
                                $youthMessage->internal_summary
                            ) }}</textarea>

                        </div>


                        {{-- Action effectuée --}}
                        <div class="mb-3">

                            <label
                                for="action_taken"
                                class="form-label fw-semibold"
                            >
                                Action effectuée
                            </label>

                            <textarea
                                id="action_taken"
                                name="action_taken"
                                rows="3"
                                class="form-control"
                                placeholder="Action réalisée par l'équipe..."
                            >{{ old(
                                'action_taken',
                                $youthMessage->action_taken
                            ) }}</textarea>

                        </div>


                        {{-- Suivi --}}
                        <div class="mb-3">

                            <label
                                for="follow_up"
                                class="form-label fw-semibold"
                            >
                                Suivi
                            </label>

                            <textarea
                                id="follow_up"
                                name="follow_up"
                                rows="3"
                                class="form-control"
                                placeholder="Prochaine étape ou suivi prévu..."
                            >{{ old(
                                'follow_up',
                                $youthMessage->follow_up
                            ) }}</textarea>

                        </div>


                        {{-- Statut --}}
                        <div class="mb-4">

                            <label
                                for="status"
                                class="form-label fw-semibold"
                            >
                                Statut
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="form-select"
                                required
                            >

                                <option
                                    value="nouveau"
                                    @selected(
                                        old(
                                            'status',
                                            $youthMessage->status
                                        ) === 'nouveau'
                                    )
                                >
                                    Nouveau
                                </option>

                                <option
                                    value="en_cours"
                                    @selected(
                                        old(
                                            'status',
                                            $youthMessage->status
                                        ) === 'en_cours'
                                    )
                                >
                                    En cours
                                </option>

                                <option
                                    value="en_attente"
                                    @selected(
                                        old(
                                            'status',
                                            $youthMessage->status
                                        ) === 'en_attente'
                                    )
                                >
                                    En attente
                                </option>

                                <option
                                    value="traite"
                                    @selected(
                                        old(
                                            'status',
                                            $youthMessage->status
                                        ) === 'traite'
                                    )
                                >
                                    Traité
                                </option>

                                <option
                                    value="clos"
                                    @selected(
                                        old(
                                            'status',
                                            $youthMessage->status
                                        ) === 'clos'
                                    )
                                >
                                    Clos
                                </option>

                            </select>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Enregistrer le traitement
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
