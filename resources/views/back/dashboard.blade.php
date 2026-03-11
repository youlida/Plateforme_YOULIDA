@extends('back.layouts.app')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Vue générale des statistiques de la plateforme')

@section('content')
<div class="container-fluid px-0">
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="icon-box bg-primary-soft">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h6>Total utilisateurs</h6>
                <h3>120</h3>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="icon-box bg-success-soft">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <h6>Articles publiés</h6>
                <h3>48</h3>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="icon-box bg-warning-soft">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                <h6>Total dons</h6>
                <h3>25</h3>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="icon-box bg-danger-soft">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <h6>Messages reçus</h6>
                <h3>16</h3>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="custom-card">
                <div class="card-header">
                    Derniers utilisateurs
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Josue Pawendtaore</td>
                                    <td>josueservicedigital@gmail.com</td>
                                    <td><span class="badge-soft-warning">SUPERADMIN</span></td>
                                    <td><span class="badge-soft-success">Actif</span></td>
                                    <td>09/03/2026</td>
                                </tr>
                                <tr>
                                    <td>Imane Diallo</td>
                                    <td>imane@example.com</td>
                                    <td><span class="badge-soft-warning">ADMIN</span></td>
                                    <td><span class="badge-soft-success">Actif</span></td>
                                    <td>08/03/2026</td>
                                </tr>
                                <tr>
                                    <td>Robert Kaboré</td>
                                    <td>robert@example.com</td>
                                    <td><span class="badge-soft-danger">USER</span></td>
                                    <td><span class="badge-soft-danger">Inactif</span></td>
                                    <td>07/03/2026</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="custom-card mb-4">
                <div class="card-header">
                    Activités récentes
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">Un nouvel utilisateur a été créé.</li>
                        <li class="list-group-item px-0">Un article a été publié.</li>
                        <li class="list-group-item px-0">Un nouveau don a été enregistré.</li>
                        <li class="list-group-item px-0">Un message de contact a été reçu.</li>
                    </ul>
                </div>
            </div>

            <div class="custom-card">
                <div class="card-header">
                    Résumé rapide
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Bénévoles :</strong> 32</p>
                    <p class="mb-2"><strong>Partenaires :</strong> 10</p>
                    <p class="mb-2"><strong>Témoignages :</strong> 14</p>
                    <p class="mb-0"><strong>Abonnés newsletter :</strong> 220</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection