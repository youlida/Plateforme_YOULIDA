@extends('back.layouts.app')

@section('title', 'Demandes de partenariat')

@section('content')

<div class="container-fluid">

    {{-- En-tête --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Demandes de partenariat</h2>
            <p class="text-muted mb-0">
                Gérez les propositions de collaboration reçues.
            </p>
        </div>

        <span class="badge bg-primary">
            {{ $requests->total() }} demande(s)
        </span>
    </div>


    {{-- Succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Filtres --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="GET"
                  action="{{ route('admin.partnership-requests.index') }}">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">
                            Recherche
                        </label>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Référence, organisation, nom, e-mail..."
                        >
                    </div>


                    <div class="col-md-3">
                        <label class="form-label">
                            Statut
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >
                            <option value="">
                                Tous les statuts
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

                            <option value="accepte"
                                @selected(request('status') === 'accepte')>
                                Accepté
                            </option>

                            <option value="refuse"
                                @selected(request('status') === 'refuse')>
                                Refusé
                            </option>

                            <option value="clos"
                                @selected(request('status') === 'clos')>
                                Clos
                            </option>
                        </select>
                    </div>


                    <div class="col-md-3 d-flex align-items-end gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Filtrer
                        </button>

                        <a
                            href="{{ route('admin.partnership-requests.index') }}"
                            class="btn btn-outline-secondary"
                        >
                            Réinitialiser
                        </a>

                    </div>

                </div>

            </form>

        </div>
    </div>


    {{-- Suppression multiple --}}
    <form
        id="bulkDeleteForm"
        method="POST"
        action="{{ route('admin.partnership-requests.bulk-delete') }}"
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

                            <th style="width:45px;">
                                <input
                                    type="checkbox"
                                    id="selectAll"
                                    class="form-check-input"
                                    title="Tout sélectionner"
                                >
                            </th>

                            <th>Référence</th>
                            <th>Date</th>
                            <th>Organisation</th>
                            <th>Contact</th>
                            <th>Recontact</th>
                            <th>Responsable</th>
                            <th>Statut</th>
                            <th class="text-end">
                                Actions
                            </th>

                        </tr>
                    </thead>


                    <tbody>

                        @forelse($requests as $partnership)

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

                            <tr>

                                <td>
                                    <input
                                        type="checkbox"
                                        name="ids[]"
                                        value="{{ $partnership->id }}"
                                        class="form-check-input partnership-checkbox"
                                    >
                                </td>


                                <td>
                                    <strong>
                                        {{ $partnership->reference }}
                                    </strong>
                                </td>


                                <td>
                                    {{ $partnership->created_at->format('d/m/Y H:i') }}
                                </td>


                                <td>
                                    {{ $partnership->organization }}
                                </td>


                                <td>
                                    <strong>
                                        {{ $partnership->contact_name }}
                                    </strong>

                                    <div class="small text-muted">
                                        {{ $partnership->email }}
                                    </div>
                                </td>


                                <td>
                                    @if($partnership->wants_callback)
                                        <span class="badge bg-success">
                                            Oui
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            Non
                                        </span>
                                    @endif
                                </td>


                                <td>
                                    {{ $partnership->assignedUser?->name ?? '—' }}
                                </td>


                                <td>
                                    <span class="badge {{ $statusClasses[$partnership->status] ?? 'bg-secondary' }}">
                                        {{ $statusLabels[$partnership->status] ?? $partnership->status }}
                                    </span>
                                </td>


                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-2">

                                        <a
                                            href="{{ route(
                                                'admin.partnership-requests.show',
                                                $partnership
                                            ) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            Consulter
                                        </a>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="deletePartnership(
                                                {{ $partnership->id }},
                                                '{{ $partnership->reference }}'
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
                                    Aucune demande de partenariat trouvée.
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
document.addEventListener('DOMContentLoaded', function () {

    const selectAll =
        document.getElementById('selectAll');

    const checkboxes =
        document.querySelectorAll(
            '.partnership-checkbox'
        );

    const bulkActions =
        document.getElementById('bulkActions');

    const selectedCount =
        document.getElementById('selectedCount');


    function updateBulkActions() {

        const checked =
            document.querySelectorAll(
                '.partnership-checkbox:checked'
            );

        const count = checked.length;

        selectedCount.textContent =
            count + ' sélectionnée(s)';

        if (count > 0) {
            bulkActions.classList.remove('d-none');
        } else {
            bulkActions.classList.add('d-none');
        }

        if (selectAll && checkboxes.length > 0) {

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

            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAll.checked;
            });

            updateBulkActions();
        }
    );


    checkboxes.forEach(function (checkbox) {

        checkbox.addEventListener(
            'change',
            updateBulkActions
        );

    });

});


function deletePartnership(id, reference) {

    if (
        !confirm(
            'Supprimer définitivement la demande ' +
            reference +
            ' ?'
        )
    ) {
        return;
    }


    const form = document.createElement('form');

    form.method = 'POST';

    form.action =
        '{{ url('/admin/partnership-requests') }}/'
        + id;


    const csrf = document.createElement('input');

    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';

    form.appendChild(csrf);


    const method = document.createElement('input');

    method.type = 'hidden';
    method.name = '_method';
    method.value = 'DELETE';

    form.appendChild(method);


    document.body.appendChild(form);

    form.submit();
}
</script>
