@extends('Associationspace.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste des collectes</h4>
                    <p class="card-description">
                        Gérez vos collectes ici.
                    </p>

                    <!-- Flash Messages -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <script>
                        setTimeout(function() {
                            $('.alert').alert('close');
                        }, 2000);
                    </script>

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <a href="{{ route('collect.create') }}" class="btn btn-primary mb-3">Ajouter une collecte</a>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date de Collecte</th>
                                    <th>État</th>
                                    <th>Dons Associés</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collections as $collection)
                                    <tr>
                                        <td>{{ $collection->dateCollecte }}</td>
                                        <td>{{ ucfirst($collection->etat) }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($collection->listeDons as $don)
                                                    <li>{{ $don->nourriture->nom }} - {{ $don->quantité }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route('collect.edit', $collection->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('collect.destroy', $collection->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Etes-vous sûr de vouloir supprimer cette collecte?');">Supprimer</button>
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
