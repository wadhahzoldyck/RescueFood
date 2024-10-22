@extends('associationspace.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ajouter une Livraison</h4>
                    <p class="card-description">
                        Remplissez les détails pour créer une nouvelle livraison.
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

                    <form action="{{ route('livraison.store') }}" method="POST">
                        @csrf

                        <!-- Sélecteur pour la distribution -->
                        <div class="form-group">
                            <label for="redistribution_id">Redistribution</label>
                            <select class="form-control" id="redistribution_id" name="redistribution_id">
                                <option value="" disabled selected>Choisir une redistribution</option>
                                @foreach($redistributions as $redistribution)
                                <option value="{{ $redistribution->id }}">{{ $redistribution->nom }}</option>
                                @endforeach
                            </select>
                            @error('redistribution_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Champ Adresse -->
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" >
                            @error('adresse')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Champ Date de livraison -->
                        <div class="form-group">
                            <label for="date_livraison">Date de Livraison</label>
                            <input type="date" class="form-control" id="date_livraison" name="date_livraison" >
                            @error('date_livraison')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sélecteur pour le livreur -->
                        <div class="form-group">
                            <label for="livreur_id">Livreur</label>
                            <select class="form-control" id="livreur_id" name="livreur_id" >
                                <option value="" disabled selected>Choisir un livreur</option>
                                @foreach($livreurs as $livreur)
                                    <option value="{{ $livreur->id }}">{{ $livreur->nom }}</option>
                                @endforeach
                            </select>
                            @error('livreur_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sélecteur pour l'état -->
                        <div class="form-group">
                            <label for="etat">État</label>
                            <select class="form-control" id="etat" name="etat" >
                                <option value="en_attente">En attente</option>
                                <option value="en_cours">En cours</option>
                                <option value="complet">Complet</option>
                            </select>
                            @error('etat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Créer Livraison</button>
                        <a href="{{ route('livraison.index') }}" class="btn btn-secondary">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
