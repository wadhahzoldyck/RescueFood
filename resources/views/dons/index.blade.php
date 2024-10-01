@extends('associationspace.layout')

@section('content')
<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des dons</h4>
                <p class="card-description">
                    Gérez vos dons ici.
                </p>

                <!-- Affichage des messages flash -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <a href="{{ route('dons.create') }}" class="btn btn-primary mb-3">Ajouter un don</a>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nourriture</th>
                                <th>Quantité</th>
                                <th>Statut</th>
                                <th>Date d'Expiration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dons as $don)
                                <tr>
                                    <td>{{ $don->nourriture->nom }} ({{ $don->nourriture->type }})</td>
                                    <td>{{ $don->quantité }}</td>
                                    <td>{{ ucfirst($don->status) }}</td>
                                    <td>{{ $don->formatted_date_expiration }}</td>
                                    <td>
                                        <a href="{{ route('dons.edit', $don->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('dons.destroy', $don->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce don?');">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>
</div>
@endsection
