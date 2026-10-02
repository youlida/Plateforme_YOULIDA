@extends('back.layouts.app')

@section('title', 'Demandes d’intervention')

@section('content')

<div class="container-fluid">

    {{-- En-tête --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Demandes d’intervention</h2>

            <p class="text-muted mb-0">
                Gérez les sollicitations d’intervention reçues.
            </p>
        </div>

        <span class="badge bg-primary">
            {{ $requests->total() }} demande(s)
        </span>
    </div>


    {{-- Message succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Filtres --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form
                method="GET"
                action="{{ route('admin.intervention-requests.index') }}"
            >

                <div class="row g-3">

                    {{-- Recherche --}}
                    <div class="col-md-5">

                        <label class="form-label">
                            Recherche
                        </label>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Référence, structure, contact, lieu..."
                        >

                    </div>


                    {{-- Type structure --}}
                    <div class="col-md-3">

                        <label class="form-label">
                            Type de structure
                        </label>

                        <select
                            name="structure_type"
                            class="form-select"
                        >

                            <option value="">
                                Tous
                            </option>

                            <option
                                value="ecole"
                                @selected(request('structure_type') === 'ecole')
                            >
                                École / établissement
                            </option>

                            <option
                                value="communaute"
                                @selected(request('structure_type') === 'communaute')
                            >
                                Communauté
                            </option>

                            <option
                                value="association"
                                @selected(request('structure_type') === 'association')
                            >
                                Association
                            </option>

                            <option
                                value="groupe_jeunes"
                                @selected(request('structure_type') === 'groupe_jeunes')
                            >
                                Groupe de jeunes
                            </option>

                            <option
                                value="evenement"
                                @selected(request('structure_type') === 'evenement')
                            >
                                Événement
                            </option>

                            <option
                                value="autre"
                                @selected(request('structure_type') === 'autre')
                            >
                                Autre
                            </option>

                        </select>

                    </div>


                    {{-- Statut --}}
                    <div class="col-md-2">

                        <label class="form-label">
                            Statut
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                Tous
                            </option>

                            <option value="nouveau"
                                @selected(request('status') === 'nouveau')>
                                Nouveau
                            </option>

                            <option value="en_cours"
                                @selected(request('status') === 'en_cours')>
                                En cours
                            </option>

                            <option value="en_attente"
                                @selected(request('status') === 'en_attente')>
                                En attente
                            </option>

                            <option value="planifie"
                                @selected(request('status') === 'planifie')>
                                Planifié
                            </option>

                            <option value="realise"
                                @selected(request('status') === 'realise')>
                                Réalisé
                            </option>

                            <option value="annule"
                                @selected(request('status') === 'annule')>
                                Annulé
                            </option>

                            <option value="clos"
                                @selected(request('status') === 'clos')>
                                Clos
                            </option>

                        </select>

                    </div>


                    <div class="col-md-2 d-flex align-items-end gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Filtrer
                        </button>

                        <a
                            href="{{ route('admin.intervention-requests.index') }}"
                            class="btn btn-outline-secondary"
                            title="Réinitialiser"
                        >
                            ↻
                        </a>

                    </div>

                </div>

            </form>

        </div>
    </div>


    {{-- Formulaire suppression multiple --}}
    <form
        id="bulkDeleteForm"
        method="POST"
        action="{{ route('admin.intervention-requests.bulk-delete') }}"
    >

        @csrf
        @method('DELETE')


        <div
            id="bulkActions"
            class="mb-3 d-none"
        >

            <button
                type="submit"
                class="btn btn-danger"
                onclick="return confirm(
                    'Supprimer définitivement les demandes sélectionnées ?'
                )"
            >
                <i class="fa-solid fa-trash me-1"></i>

                Supprimer la sélection
            </button>

            <span
                id="selectedCount"
                class="ms-2 text-muted"
            >
                0 sélectionnée(s)
            </span>

        </div>


        {{-- Tableau --}}
        <div class="card shadow-sm">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>

                            <th style="width: 45px;">

                                <input
                                    type="checkbox"
                                    id="selectAllInterventions"
                                    class="form-check-input"
                                >

                            </th>

                            <th>Référence</th>

                            <th>Date</th>

                            <th>Structure</th>

                            <th>Contact</th>

                            <th>Lieu</th>

                            <th>Format</th>

                            <th>Statut</th>

                            <th class="text-end">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($requests as $intervention)

                            @php

                                $structureLabels = [
                                    'ecole' => 'École',
                                    'communaute' => 'Communauté',
                                    'association' => 'Association',
                                    'groupe_jeunes' => 'Groupe de jeunes',
                                    'evenement' => 'Événement',
                                    'autre' => 'Autre',
                                ];

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

                            @endphp


                            <tr>

                                {{-- Checkbox --}}
                                <td>

                                    <input
                                        type="checkbox"
                                        name="ids[]"
                                        value="{{ $intervention->id }}"
                                        class="form-check-input intervention-checkbox"
                                    >

                                </td>


                                {{-- Référence --}}
                                <td>

                                    <strong>
                                        {{ $intervention->reference }}
                                    </strong>

                                </td>


                                {{-- Date --}}
                                <td>

                                    {{ $intervention->created_at->format('d/m/Y H:i') }}

                                </td>


                                {{-- Structure --}}
                                <td>

                                    <strong>
                                        {{ $intervention->structure_name ?: '—' }}
                                    </strong>

                                    <div class="small text-muted">

                                        {{
                                            $structureLabels[
                                                $intervention->structure_type
                                            ]
                                            ?? $intervention->structure_type
                                        }}

                                    </div>

                                </td>


                                {{-- Contact --}}
                                <td>

                                    {{ $intervention->contact_name }}

                                    @if($intervention->phone)

                                        <div class="small text-muted">
                                            {{ $intervention->phone }}
                                        </div>

                                    @elseif($intervention->email)

                                        <div class="small text-muted">
                                            {{ $intervention->email }}
                                        </div>

                                    @endif

                                </td>


                                {{-- Lieu --}}
                                <td>
                                    {{ $intervention->location }}
                                </td>


                                {{-- Format --}}
                                <td>

                                    @if($intervention->intervention_format === 'ponctuelle')

                                        <span class="badge bg-light text-dark">
                                            Ponctuelle
                                        </span>

                                    @else

                                        <span class="badge bg-light text-dark">
                                            Sur une durée
                                        </span>

                                    @endif

                                </td>


                                {{-- Statut --}}
                                <td>

                                    <span
                                        class="badge {{
                                            $statusClasses[
                                                $intervention->status
                                            ] ?? 'bg-secondary'
                                        }}"
                                    >

                                        {{
                                            $statusLabels[
                                                $intervention->status
                                            ] ?? $intervention->status
                                        }}

                                    </span>

                                </td>


                                {{-- Actions --}}
                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-2">

                                        <a
                                            href="{{ route(
                                                'admin.intervention-requests.show',
                                                $intervention
                                            ) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            Consulter
                                        </a>


                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="deleteIntervention(
                                                {{ $intervention->id }},
                                                '{{ $intervention->reference }}'
                                            )"
                                        >
                                            Supprimer
                                        </button>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="9"
                                    class="text-center py-5 text-muted"
                                >
                                    Aucune demande d’intervention trouvée.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </form>


    {{-- Pagination --}}
    <div class="mt-4">
        {{ $requests->links() }}
    </div>

</div>

@endsection


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const selectAll =
            document.getElementById(
                'selectAllInterventions'
            );

        const checkboxes =
            document.querySelectorAll(
                '.intervention-checkbox'
            );

        const bulkActions =
            document.getElementById(
                'bulkActions'
            );

        const selectedCount =
            document.getElementById(
                'selectedCount'
            );


        function updateBulkActions() {

            const checked =
                document.querySelectorAll(
                    '.intervention-checkbox:checked'
                );

            const count = checked.length;

            selectedCount.textContent =
                count + ' sélectionnée(s)';


            if (count > 0) {

                bulkActions.classList.remove(
                    'd-none'
                );

            } else {

                bulkActions.classList.add(
                    'd-none'
                );

            }


            if (
                selectAll &&
                checkboxes.length > 0
            ) {

                selectAll.checked =
                    count === checkboxes.length;

                selectAll.indeterminate =
                    count > 0 &&
                    count < checkboxes.length;

            }

        }


        selectAll?.addEventListener(
            'change',
            function () {

                checkboxes.forEach(
                    function (checkbox) {

                        checkbox.checked =
                            selectAll.checked;

                    }
                );

                updateBulkActions();

            }
        );


        checkboxes.forEach(
            function (checkbox) {

                checkbox.addEventListener(
                    'change',
                    updateBulkActions
                );

            }
        );

    }
);


function deleteIntervention(id, reference) {

    if (
        !confirm(
            'Supprimer définitivement la demande '
            + reference +
            ' ?'
        )
    ) {
        return;
    }


    const form =
        document.createElement('form');

    form.method = 'POST';

    form.action =
        '{{ url('/admin/intervention-requests') }}/'
        + id;


    const csrf =
        document.createElement('input');

    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';

    form.appendChild(csrf);


    const method =
        document.createElement('input');

    method.type = 'hidden';
    method.name = '_method';
    method.value = 'DELETE';

    form.appendChild(method);


    document.body.appendChild(form);

    form.submit();
}

</script>
