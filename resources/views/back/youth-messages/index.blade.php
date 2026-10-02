@extends('back.layouts.app')

@section('title', 'Messages des jeunes')

@section('content')

<div class="container-fluid">

    {{-- En-tête --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Messages des jeunes</h1>
            <p class="text-muted mb-0">
                Consultez et traitez les demandes reçues depuis l'espace d'écoute YOULIDA.
            </p>
        </div>

        <span class="badge bg-primary fs-6">
            {{ $messages->total() }} demande(s)
        </span>
    </div>


    {{-- Message succès --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- Filtres --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form
                method="GET"
                action="{{ route('admin.youth-messages.index') }}"
                class="row g-3"
            >

                {{-- Recherche --}}
                <div class="col-md-4">
                    <label class="form-label">
                        Recherche
                    </label>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Référence ou contact..."
                        value="{{ request('search') }}"
                    >
                </div>


                {{-- Statut --}}
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

                        <option
                            value="nouveau"
                            @selected(request('status') === 'nouveau')
                        >
                            Nouveau
                        </option>

                        <option
                            value="en_cours"
                            @selected(request('status') === 'en_cours')
                        >
                            En cours
                        </option>

                        <option
                            value="en_attente"
                            @selected(request('status') === 'en_attente')
                        >
                            En attente
                        </option>

                        <option
                            value="traite"
                            @selected(request('status') === 'traite')
                        >
                            Traité
                        </option>

                        <option
                            value="clos"
                            @selected(request('status') === 'clos')
                        >
                            Clos
                        </option>
                    </select>
                </div>


                {{-- Catégorie --}}
                <div class="col-md-3">
                    <label class="form-label">
                        Catégorie
                    </label>

                    <select
                        name="category"
                        class="form-select"
                    >
                        <option value="">
                            Toutes les catégories
                        </option>

                        <option value="ecole" @selected(request('category') === 'ecole')>
                            École / études
                        </option>

                        <option value="famille" @selected(request('category') === 'famille')>
                            Famille
                        </option>

                        <option value="relations" @selected(request('category') === 'relations')>
                            Relations / amitiés
                        </option>

                        <option value="bien-etre" @selected(request('category') === 'bien-etre')>
                            Santé / bien-être
                        </option>

                        <option value="sante-sexuelle" @selected(request('category') === 'sante-sexuelle')>
                            Santé sexuelle
                        </option>

                        <option value="violence" @selected(request('category') === 'violence')>
                            Violence / harcèlement
                        </option>

                        <option value="substances" @selected(request('category') === 'substances')>
                            Drogues / substances
                        </option>

                        <option value="orientation" @selected(request('category') === 'orientation')>
                            Orientation / avenir
                        </option>

                        <option value="autre" @selected(request('category') === 'autre')>
                            Autre
                        </option>

                        <option value="non-precise" @selected(request('category') === 'non-precise')>
                            Préfère ne pas préciser
                        </option>
                    </select>
                </div>


                {{-- Boutons --}}
                <div class="col-md-2 d-flex align-items-end gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Filtrer
                    </button>

                    <a
                        href="{{ route('admin.youth-messages.index') }}"
                        class="btn btn-outline-secondary"
                        title="Réinitialiser"
                    >
                        ↻
                    </a>

                </div>

            </form>

        </div>
    </div>


    {{-- Tableau --}}
    <form
    id="bulkDeleteForm"
    method="POST"
    action="{{ route('admin.youth-messages.bulk-delete') }}"
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
            onclick="
                return confirm(
                    'Supprimer définitivement les demandes sélectionnées ?'
                );
            "
        >
            Supprimer la sélection
        </button>

        <span
            id="selectedCount"
            class="ms-2 text-muted"
        >
            0 sélectionnée
        </span>
    </div>

    <div class="card shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th style="width: 45px;">
    <input
        type="checkbox"
        id="selectAll"
        class="form-check-input"
        title="Tout sélectionner"
    >
</th>
                            <th>Référence</th>
                            <th>Date</th>
                            <th>Catégorie</th>
                            <th>Rappel</th>
                            <th>Qualification</th>
                            <th>Statut</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($messages as $message)

                            <tr>
<td>
    <input
        type="checkbox"
        name="ids[]"
        value="{{ $message->id }}"
        class="form-check-input message-checkbox"
    >
</td>
                                {{-- Référence --}}
                                <td>
                                    <strong>
                                        {{ $message->reference }}
                                    </strong>

                                    @if($message->audio_path)
                                        <div>
                                            <small class="text-muted">
                                                🎙️ Message vocal
                                            </small>
                                        </div>
                                    @endif
                                </td>


                                {{-- Date --}}
                                <td>
                                    {{ $message->created_at->format('d/m/Y') }}

                                    <br>

                                    <small class="text-muted">
                                        {{ $message->created_at->format('H:i') }}
                                    </small>
                                </td>


                                {{-- Catégorie --}}
                                <td>
                                    @switch($message->category)

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
                                            Non précisé
                                            @break

                                        @default
                                            <span class="text-muted">
                                                Non précisé
                                            </span>

                                    @endswitch
                                </td>


                                {{-- Rappel --}}
                                <td>

                                    @if($message->wants_callback)

                                        <span class="badge bg-warning text-dark">
                                            Oui
                                        </span>

                                        @if($message->callback_channel)
                                            <div>
                                                <small class="text-muted">
                                                    {{ ucfirst($message->callback_channel) }}
                                                </small>
                                            </div>
                                        @endif

                                    @else

                                        <span class="badge bg-secondary">
                                            Non
                                        </span>

                                    @endif

                                </td>


                                {{-- Qualification --}}
                                <td>

                                    @if($message->qualification)

                                        <span class="badge bg-info text-dark">
                                            {{ $message->qualification }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Statut --}}
                                <td>

                                    @switch($message->status)

                                        @case('nouveau')
                                            <span class="badge bg-danger">
                                                Nouveau
                                            </span>
                                            @break

                                        @case('en_cours')
                                            <span class="badge bg-primary">
                                                En cours
                                            </span>
                                            @break

                                        @case('en_attente')
                                            <span class="badge bg-warning text-dark">
                                                En attente
                                            </span>
                                            @break

                                        @case('traite')
                                            <span class="badge bg-success">
                                                Traité
                                            </span>
                                            @break

                                        @case('clos')
                                            <span class="badge bg-secondary">
                                                Clos
                                            </span>
                                            @break

                                        @default
                                            {{ $message->status }}

                                    @endswitch

                                </td>


                                {{-- Action --}}
                                <td class="text-end">

    <div class="d-flex justify-content-end gap-2">

        <a
            href="{{ route(
                'admin.youth-messages.show',
                $message
            ) }}"
            class="btn btn-sm btn-outline-primary"
        >
            Consulter
        </a>

        <button
            type="button"
            class="btn btn-sm btn-outline-danger"
            onclick="deleteYouthMessage(
                {{ $message->id }},
                '{{ $message->reference }}'
            )"
        >
            Supprimer
        </button>

    </div>

</td>

                            </tr>

                        @empty

                            <tr>
                                <td>
    <input
        type="checkbox"
        name="ids[]"
        value="{{ $message->id }}"
        class="form-check-input message-checkbox"
    >
</td>
                                <td
                                    colspan="8"
                                    class="text-center py-5 text-muted"
                                >
                                    Aucun message trouvé.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>
    </form>


    {{-- Pagination --}}
    @if($messages->hasPages())

        <div class="mt-4">
            {{ $messages->links() }}
        </div>

    @endif

</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {

    const selectAll = document.getElementById('selectAll');

    const checkboxes = document.querySelectorAll(
        '.message-checkbox'
    );

    const bulkActions = document.getElementById(
        'bulkActions'
    );

    const selectedCount = document.getElementById(
        'selectedCount'
    );

    function updateBulkActions() {

        const checked = document.querySelectorAll(
            '.message-checkbox:checked'
        );

        const count = checked.length;

        selectedCount.textContent =
            count + ' sélectionnée(s)';

        if (count > 0) {
            bulkActions.classList.remove('d-none');
        } else {
            bulkActions.classList.add('d-none');
        }

        if (checkboxes.length > 0) {

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

function deleteYouthMessage(id, reference) {

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
        '{{ url('/admin/youth-messages') }}/' + id;

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
