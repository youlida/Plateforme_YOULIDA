@extends('back.layouts.app')

@section('title', 'Demande de partenariat')

@section('content')

<div class="container-fluid">

    {{-- Retour --}}
    <div class="mb-4">
        <a
            href="{{ route('admin.partnership-requests.index') }}"
            class="btn btn-outline-secondary btn-sm"
        >
            ← Retour aux demandes
        </a>
    </div>


    {{-- Message succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- En-tête --}}
    <div class="d-flex justify-content-between align-items-start mb-4">

        <div>
            <h2 class="mb-1">
                Demande de partenariat
            </h2>

            <p class="text-muted mb-0">
                Référence :
                <strong>
                    {{ $partnershipRequest->reference }}
                </strong>
            </p>
        </div>


        @php
            $statusLabels = [
                'nouveau' => 'Nouveau',
                'en_cours' => 'En cours',
                'en_attente' => 'En attente',
                'accepte' => 'Accepté',
                'refuse' => 'Refusé',
                'clos' => 'Clos',
            ];

            $statusClasses = [
                'nouveau' => 'bg-primary',
                'en_cours' => 'bg-warning text-dark',
                'en_attente' => 'bg-secondary',
                'accepte' => 'bg-success',
                'refuse' => 'bg-danger',
                'clos' => 'bg-dark',
            ];
        @endphp

        <span
            class="badge {{ $statusClasses[$partnershipRequest->status] ?? 'bg-secondary' }}"
        >
            {{ $statusLabels[$partnershipRequest->status] ?? $partnershipRequest->status }}
        </span>

    </div>


    <div class="row g-4">

        {{-- ======================================================
             COLONNE GAUCHE
        ======================================================= --}}
        <div class="col-lg-7">


            {{-- ORGANISATION --}}
            <div class="card shadow-sm mb-4">

                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        Informations du partenaire
                    </h5>
                </div>

                <div class="card-body">

                    <div class="row g-4">

                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                Organisation
                            </small>

                            <strong>
                                {{ $partnershipRequest->organization }}
                            </strong>
                        </div>


                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                Nom du contact
                            </small>

                            <strong>
                                {{ $partnershipRequest->contact_name }}
                            </strong>
                        </div>


                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                Fonction
                            </small>

                            <span>
                                {{ $partnershipRequest->contact_function ?: 'Non renseignée' }}
                            </span>
                        </div>


                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                Date de réception
                            </small>

                            <span>
                                {{ $partnershipRequest->created_at->format('d/m/Y à H:i') }}
                            </span>
                        </div>


                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                E-mail
                            </small>

                            <a
                                href="mailto:{{ $partnershipRequest->email }}"
                            >
                                {{ $partnershipRequest->email }}
                            </a>
                        </div>


                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                Téléphone
                            </small>

                            @if($partnershipRequest->phone)

                                <a
                                    href="tel:{{ $partnershipRequest->phone }}"
                                >
                                    {{ $partnershipRequest->phone }}
                                </a>

                            @else

                                <span>
                                    Non renseigné
                                </span>

                            @endif
                        </div>


                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                Souhaite être recontacté
                            </small>

                            @if($partnershipRequest->wants_callback)

                                <span class="badge bg-success">
                                    Oui
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Non
                                </span>

                            @endif
                        </div>

                    </div>

                </div>

            </div>


            {{-- PROPOSITION --}}
            <div class="card shadow-sm">

                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        Proposition de collaboration
                    </h5>
                </div>

                <div class="card-body">

                    <div
                        class="p-3 bg-light rounded"
                        style="white-space: pre-wrap;"
                    >{{ $partnershipRequest->proposal }}</div>

                </div>

            </div>

        </div>


        {{-- ======================================================
             COLONNE DROITE : TRAITEMENT
        ======================================================= --}}
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
                            'admin.partnership-requests.update',
                            $partnershipRequest
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
                                                $partnershipRequest->assigned_to
                                            ) == $user->id
                                        )
                                    >
                                        {{ $user->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Résumé --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Résumé interne
                            </label>

                            <textarea
                                name="internal_summary"
                                class="form-control"
                                rows="4"
                                placeholder="Résumé factuel de la demande..."
                            >{{ old(
                                'internal_summary',
                                $partnershipRequest->internal_summary
                            ) }}</textarea>

                        </div>


                        {{-- Action --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Action effectuée
                            </label>

                            <textarea
                                name="action_taken"
                                class="form-control"
                                rows="3"
                                placeholder="Ex. E-mail envoyé, appel effectué..."
                            >{{ old(
                                'action_taken',
                                $partnershipRequest->action_taken
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
                                placeholder="Prochaine étape, rendez-vous..."
                            >{{ old(
                                'follow_up',
                                $partnershipRequest->follow_up
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
                                            $partnershipRequest->status
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
                                            $partnershipRequest->status
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
                                            $partnershipRequest->status
                                        ) === 'en_attente'
                                    )
                                >
                                    En attente
                                </option>

                                <option
                                    value="accepte"
                                    @selected(
                                        old(
                                            'status',
                                            $partnershipRequest->status
                                        ) === 'accepte'
                                    )
                                >
                                    Accepté
                                </option>

                                <option
                                    value="refuse"
                                    @selected(
                                        old(
                                            'status',
                                            $partnershipRequest->status
                                        ) === 'refuse'
                                    )
                                >
                                    Refusé
                                </option>

                                <option
                                    value="clos"
                                    @selected(
                                        old(
                                            'status',
                                            $partnershipRequest->status
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
                            <i class="fa-solid fa-floppy-disk me-1"></i>
                            Enregistrer le traitement
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
