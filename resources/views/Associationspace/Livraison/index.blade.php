@extends('associationspace.layout')

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

                    <script>
                        // Wait 2 seconds (2000 milliseconds) before closing the alert
                        setTimeout(function() {
                            // Find the alert and trigger the dismiss (fade out and remove)
                            $('.alert').alert('close');
                        }, 2000);
                    </script>

                    <p class="card-title mb-0">Liste des livraisons</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Adresse</th>
                                    <th>Date de Livraison</th>
                                    <th>Livreur</th>
                                    <th>État</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($livraisons as $livraison)
                                <tr>
                                    <td>{{ $livraison->adresse }}</td>
                                    <td>{{ \Carbon\Carbon::parse($livraison->date_livraison)->format('d/m/Y') }}</td>
                                    <td>{{ $livraison->livreur->nom ?? 'Non attribué' }}</td>
                                    <td>
                                        @if($livraison->etat === 'en_attente')
                                            <div class="badge badge-warning">En attente</div>
                                        @elseif($livraison->etat === 'en_cours')
                                            <div class="badge badge-info">En cours</div>
                                        @else
                                            <div class="badge badge-success">Complet</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('livraison.edit', $livraison->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Éditer
                                        </a>
                                        <form action="{{ route('livraison.destroy', $livraison->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette livraison ?')">
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
