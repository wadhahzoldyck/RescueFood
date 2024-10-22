@extends('Associationspace.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ajouter une collecte</h4>
                    <p class="card-description">
                        Remplissez les détails pour créer une nouvelle collecte.
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

                    <form action="{{ route('collect.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="titre" name="titre" placeholder="Titre de la collection" required>
                            @error('titre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="dateCollecte">Date de collecte</label>
                            <input type="date" class="form-control" id="dateCollecte" name="dateCollecte" required>
                        </div>

                        <div class="form-group">
                            <label for="etat">État</label>
                            <select class="form-control" id="etat" name="etat" required>
                                <option value="en attente">En attente</option>
                                <option value="confirmé">Confirmé</option>
                                <option value="annulé">Annulé</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dons">Sélectionner des dons</label>
                            <select class="form-control" id="dons" name="dons[]" multiple required>
                                @foreach($dons as $don)
                                    <option value="{{ $don->id }}">
                                        {{ $don->nourriture->nom }} ({{ $don->nourriture->type }}) - {{ $don->quantité }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Créer Collecte</button>
                        <a href="{{ route('collect.index') }}" class="btn btn-secondary">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
