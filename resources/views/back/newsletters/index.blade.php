@extends('back.layouts.app')

@section('title','Newsletter')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Abonnés Newsletter</h4>

        <a href="{{ route('admin.newsletters.create') }}" class="btn btn-primary">
            Ajouter un abonné
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Actif</th>
                <th>Date</th>
                <th width="200">Actions</th>
            </tr>
        </thead>

        <tbody>

        @forelse($abonnements as $abonne)

            <tr>
                <td>{{ $abonne->id }}</td>

                <td>{{ $abonne->email }}</td>

                <td>
                    @if($abonne->is_active)
                        <span class="badge bg-success">Oui</span>
                    @else
                        <span class="badge bg-danger">Non</span>
                    @endif
                </td>

                <td>{{ $abonne->created_at->format('d/m/Y') }}</td>

                <td>

                    <a href="{{ route('admin.newsletters.show',$abonne->id) }}"
                       class="btn btn-info btn-sm">
                        Voir
                    </a>

                    <a href="{{ route('admin.newsletters.edit',$abonne->id) }}"
                       class="btn btn-warning btn-sm">
                        Modifier
                    </a>

                    <form action="{{ route('admin.newsletters.destroy',$abonne->id) }}"
                          method="POST"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Supprimer cet abonné ?')">
                            Supprimer
                        </button>

                    </form>

                </td>
            </tr>

        @empty

            <tr>
                <td colspan="5">Aucun abonné trouvé</td>
            </tr>

        @endforelse

        </tbody>
    </table>

    {{ $abonnements->links() }}

</div>

@endsection