@extends('back.layouts.app')

@section('title','Dons')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Liste des dons</h4>

        <a href="{{ route('admin.dons.create') }}" class="btn btn-primary">
            Ajouter un don
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Donateur</th>
                        <th>Email</th>
                        <th>Montant</th>
                        <th>Méthode</th>
                        <th>Date</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($dons as $don)
                        <tr>
                            <td>{{ $don->id }}</td>
                            <td>{{ $don->donor_name }}</td>
                            <td>{{ $don->email }}</td>
                            <td><strong>{{ number_format($don->amount, 2) }}</strong></td>
                            <td>{{ $don->payment_method }}</td>
                            <td>
                                @if($don->donated_at)
                                    {{ \Carbon\Carbon::parse($don->donated_at)->format('d/m/Y') }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.dons.show', $don->id) }}" class="btn btn-info btn-sm">
                                    Voir
                                </a>

                                <a href="{{ route('admin.dons.edit', $don->id) }}" class="btn btn-warning btn-sm">
                                    Modifier
                                </a>

                                <form action="{{ route('admin.dons.destroy', $don->id) }}"
                                      method="POST"
                                      style="display:inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Supprimer ce don ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Aucun don trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $dons->links() }}

        </div>
    </div>

</div>

@endsection