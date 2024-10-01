@extends('Associationspace.layout')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    <p class="card-title mb-0">Liste des livreurs</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>Véhicule</th>
                                    <th>Zone de couverture</th>
                                    <th>Disponibilité</th>
                                    <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($livreurs as $livreur)
                                <tr>
                                    <td>{{ $livreur->nom }}</td>
                                    <td class="font-weight-bold">{{ $livreur->telephone }}</td>
                                    <td>{{ $livreur->vehicule }}</td>
                                    <td>{{ $livreur->zone_couverture }}</td>
                                    <td class="font-weight-medium">
                                        @if($livreur->disponibilite)
                                            <div class="badge badge-success">Disponible</div>
                                        @else
                                            <div class="badge badge-danger">Non disponible</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a  href="{{ route('livreurs.edit', $livreur->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Éditer
                                        </a>
                                        <form action="{{ route('livreurs.destroy', $livreur->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livreur ?')">
                                                <i class="fas fa-trash-alt"></i> Supprimer
                                            </button>
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
