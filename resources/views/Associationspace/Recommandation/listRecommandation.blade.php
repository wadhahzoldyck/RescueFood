@extends('Associationspace.layout')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Liste des recommandations</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Catégorie</th>
                                    <th>Priorité</th>
                                    <th>Date de création</th>
                                    <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recommandations as $recommandation)
                                <tr>
                                    <td>{{ $recommandation->titre }}</td>
                                    <td>{{ $recommandation->description }}</td>
                                    <td>{{ $recommandation->categorie }}</td>
                                    <td>
                                        @if($recommandation->priorite == 1)
                                            <div class="badge badge-danger">Haute</div>
                                        @elseif($recommandation->priorite == 2)
                                            <div class="badge badge-warning">Moyenne</div>
                                        @else
                                            <div class="badge badge-success">Basse</div>
                                        @endif
                                    </td>
                                    <td>{{ $recommandation->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('recommandations.edit', $recommandation->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Éditer
                                        </a>
                                        <form action="{{ route('recommandations.destroy', $recommandation->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recommandation ?')">
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
