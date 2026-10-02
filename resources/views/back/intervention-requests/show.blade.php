@extends('back.layouts.app')

@section('title', 'Demande d’intervention')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
         RETOUR
    ========================================================== --}}
    <div class="mb-4">

        <a
            href="{{ route('admin.intervention-requests.index') }}"
            class="btn btn-outline-secondary btn-sm"
        >
            ← Retour aux demandes
        </a>

    </div>


    {{-- =========================================================
         MESSAGE DE SUCCÈS
    ========================================================== --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- =========================================================
         ERREURS DE VALIDATION
    ========================================================== --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Certaines informations doivent être corrigées.
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
         STATUTS
    ========================================================== --}}
    @php

        $statusLabels = [
            'nouveau' => 'Nouveau',
            'en_cours' => 'En cours',
            'en_attente' => 'En attente',
            'planifie' => 'Planifié',
            'realise' => 'Réalisé',
            'annule' => 'Annulé',
            'clos' => 'Clos',
        ];

        $statusClasses = [
            'nouveau' => 'bg-primary',
            'en_cours' => 'bg-warning text-dark',
            'en_attente' => 'bg-secondary',
            'planifie' => 'bg-info text-dark',
            'realise' => 'bg-success',
            'annule' => 'bg-danger',
            'clos' => 'bg-dark',
        ];


        $structureLabels = [
            'ecole' => 'École / établissement',
            'communaute' => 'Communauté',
            'association' => 'Association',
            'groupe_jeunes' => 'Groupe de jeunes',
            'evenement' => 'Événement',
            'autre' => 'Autre',
        ];

    @endphp


    {{-- =========================================================
         EN-TÊTE
    ========================================================== --}}
    <div
        class="d-flex justify-content-between align-items-start mb-4"
    >

        <div>

            <h2 class="mb-1">
                Demande d’intervention
            </h2>

            <p class="text-muted mb-0">

                Référence :

                <strong>
                    {{ $interventionRequest->reference }}
                </strong>

            </p>

        </div>


        <span
            class="badge {{
                $statusClasses[
                    $interventionRequest->status
                ] ?? 'bg-secondary'
            }}"
        >

            {{
                $statusLabels[
                    $interventionRequest->status
                ] ?? $interventionRequest->status
            }}

        </span>

    </div>


    <div class="row g-4">


        {{-- =====================================================
             COLONNE GAUCHE
        ====================================================== --}}
        <div class="col-lg-7">


            {{-- ================================================
                 STRUCTURE ET CONTACT
            ================================================= --}}
            <div class="card shadow-sm mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Structure et contact
                    </h5>

                </div>


                <div class="card-body">

                    <div class="row g-4">


                        {{-- Type structure --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Type de structure
                            </small>

                            <strong>

                                {{
                                    $structureLabels[
                                        $interventionRequest->structure_type
                                    ]
                                    ?? $interventionRequest->structure_type
                                }}

                            </strong>

                        </div>


                        {{-- Nom structure --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Nom de la structure
                            </small>

                            <strong>

                                {{
                                    $interventionRequest->structure_name
                                    ?: 'Non renseigné'
                                }}

                            </strong>

                        </div>


                        {{-- Contact --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Personne à contacter
                            </small>

                            <strong>
                                {{ $interventionRequest->contact_name }}
                            </strong>

                        </div>


                        {{-- Fonction --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Fonction
                            </small>

                            <span>

                                {{
                                    $interventionRequest->contact_function
                                    ?: 'Non renseignée'
                                }}

                            </span>

                        </div>


                        {{-- Téléphone --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Téléphone
                            </small>

                            @if($interventionRequest->phone)

                                <a
                                    href="tel:{{ $interventionRequest->phone }}"
                                >
                                    {{ $interventionRequest->phone }}
                                </a>

                            @else

                                <span>
                                    Non renseigné
                                </span>

                            @endif

                        </div>


                        {{-- Email --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                E-mail
                            </small>

                            @if($interventionRequest->email)

                                <a
                                    href="mailto:{{ $interventionRequest->email }}"
                                >
                                    {{ $interventionRequest->email }}
                                </a>

                            @else

                                <span>
                                    Non renseigné
                                </span>

                            @endif

                        </div>


                        {{-- Date --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Date de réception
                            </small>

                            <span>

                                {{
                                    $interventionRequest
                                        ->created_at
                                        ->format('d/m/Y à H:i')
                                }}

                            </span>

                        </div>


                        {{-- Lieu --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Lieu de l’intervention
                            </small>

                            <strong>
                                {{ $interventionRequest->location }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================
                 BESOIN
            ================================================= --}}
            <div class="card shadow-sm mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Besoin / situation
                    </h5>

                </div>


                <div class="card-body">

                    <div
                        class="p-3 bg-light rounded"
                        style="white-space: pre-wrap;"
                    >{{ $interventionRequest->need }}</div>

                </div>

            </div>


            {{-- ================================================
                 INFORMATIONS INTERVENTION
            ================================================= --}}
            <div class="card shadow-sm mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Informations sur l’intervention
                    </h5>

                </div>


                <div class="card-body">

                    <div class="row g-4">


                        {{-- Public --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Public concerné
                            </small>

                            <strong>
                                {{ $interventionRequest->target_audience }}
                            </strong>

                        </div>


                        {{-- Participants --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Nombre approximatif de participants
                            </small>

                            <span>

                                {{
                                    $interventionRequest->estimated_participants
                                    ?: 'Non renseigné'
                                }}

                            </span>

                        </div>


                        {{-- Période --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Période souhaitée
                            </small>

                            <span>

                                {{
                                    $interventionRequest->desired_period
                                    ?: 'Non renseignée'
                                }}

                            </span>

                        </div>


                        {{-- Format --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Type d’intervention
                            </small>

                            @if(
                                $interventionRequest->intervention_format
                                === 'ponctuelle'
                            )

                                <span class="badge bg-light text-dark">
                                    Intervention ponctuelle
                                </span>

                            @else

                                <span class="badge bg-light text-dark">
                                    Intervention sur une durée
                                </span>

                            @endif

                        </div>


                        {{-- Durée --}}
                        @if(
                            $interventionRequest->intervention_format
                            === 'duree'
                        )

                            <div class="col-md-6">

                                <small class="text-muted d-block">
                                    Durée souhaitée
                                </small>

                                <strong>

                                    {{
                                        $interventionRequest->duration
                                        ?: 'Non renseignée'
                                    }}

                                </strong>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- ================================================
                 INFORMATIONS COMPLÉMENTAIRES
            ================================================= --}}
            <div class="card shadow-sm">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Informations complémentaires
                    </h5>

                </div>


                <div class="card-body">

                    @if($interventionRequest->additional_information)

                        <div
                            class="p-3 bg-light rounded"
                            style="white-space: pre-wrap;"
                        >{{ $interventionRequest->additional_information }}</div>

                    @else

                        <span class="text-muted">
                            Aucune information complémentaire.
                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
             COLONNE DROITE
             TRAITEMENT INTERNE
        ====================================================== --}}
        <div class="col-lg-5">

            <div class="card shadow-sm">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Traitement interne
                    </h5>

                </div>


                <div class="card-body">

                    <form
                        method="POST"
                        action="{{ route(
                            'admin.intervention-requests.update',
                            $interventionRequest
                        ) }}"
                    >

                        @csrf
                        @method('PUT')


                        {{-- Responsable --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Responsable
                            </label>

                            <select
                                name="assigned_to"
                                class="form-select"
                            >

                                <option value="">
                                    Non attribué
                                </option>


                                @foreach($users as $user)

                                    <option
                                        value="{{ $user->id }}"
                                        @selected(
                                            old(
                                                'assigned_to',
                                                $interventionRequest->assigned_to
                                            ) == $user->id
                                        )
                                    >

                                        {{ $user->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Résumé interne --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Résumé interne
                            </label>

                            <textarea
                                name="internal_summary"
                                class="form-control"
                                rows="4"
                                maxlength="5000"
                                placeholder="Résumé factuel de la demande..."
                            >{{ old(
                                'internal_summary',
                                $interventionRequest->internal_summary
                            ) }}</textarea>

                        </div>


                        {{-- Action effectuée --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Action effectuée
                            </label>

                            <textarea
                                name="action_taken"
                                class="form-control"
                                rows="3"
                                maxlength="5000"
                                placeholder="Ex. Appel effectué, échange avec la structure..."
                            >{{ old(
                                'action_taken',
                                $interventionRequest->action_taken
                            ) }}</textarea>

                        </div>


                        {{-- Suivi --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Suivi
                            </label>

                            <textarea
                                name="follow_up"
                                class="form-control"
                                rows="3"
                                maxlength="5000"
                                placeholder="Ex. Confirmer la date, préparer l'équipe..."
                            >{{ old(
                                'follow_up',
                                $interventionRequest->follow_up
                            ) }}</textarea>

                        </div>


                        {{-- Statut --}}
                        <div class="mb-4">

                            <label class="form-label">
                                Statut *
                            </label>

                            <select
                                name="status"
                                class="form-select"
                                required
                            >

                                <option
                                    value="nouveau"
                                    @selected(
                                        old(
                                            'status',
                                            $interventionRequest->status
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
                                            $interventionRequest->status
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
                                            $interventionRequest->status
                                        ) === 'en_attente'
                                    )
                                >
                                    En attente
                                </option>


                                <option
                                    value="planifie"
                                    @selected(
                                        old(
                                            'status',
                                            $interventionRequest->status
                                        ) === 'planifie'
                                    )
                                >
                                    Planifié
                                </option>


                                <option
                                    value="realise"
                                    @selected(
                                        old(
                                            'status',
                                            $interventionRequest->status
                                        ) === 'realise'
                                    )
                                >
                                    Réalisé
                                </option>


                                <option
                                    value="annule"
                                    @selected(
                                        old(
                                            'status',
                                            $interventionRequest->status
                                        ) === 'annule'
                                    )
                                >
                                    Annulé
                                </option>


                                <option
                                    value="clos"
                                    @selected(
                                        old(
                                            'status',
                                            $interventionRequest->status
                                        ) === 'clos'
                                    )
                                >
                                    Clos
                                </option>

                            </select>

                        </div>


                        {{-- Enregistrer --}}
                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >

                            <i class="fa-solid fa-floppy-disk me-1"></i>

                            Enregistrer le traitement

                        </button>

                    </form>

                </div>

            </div>


            {{-- =================================================
                 RÉSUMÉ RAPIDE
            ================================================== --}}
            <div class="card shadow-sm mt-4">

                <div class="card-header bg-white">

                    <h6 class="mb-0">
                        Résumé de la demande
                    </h6>

                </div>


                <div class="card-body">

                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Référence
                        </small>

                        <strong>
                            {{ $interventionRequest->reference }}
                        </strong>

                    </div>


                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Responsable actuel
                        </small>

                        <span>

                            {{
                                $interventionRequest
                                    ->assignedUser
                                    ?->name
                                ?? 'Non attribué'
                            }}

                        </span>

                    </div>


                    <div>

                        <small class="text-muted d-block">
                            Dernière modification
                        </small>

                        <span>

                            {{
                                $interventionRequest
                                    ->updated_at
                                    ->format('d/m/Y à H:i')
                            }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
