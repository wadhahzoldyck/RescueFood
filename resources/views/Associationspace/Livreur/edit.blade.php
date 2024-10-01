@extends('Associationspace.layout')

@section('content')
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-6 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <h4>Modifier le livreur</h4>
                    <form class="pt-3" method="POST" action="{{ route('livreurs.update', $livreur->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Champ pour le nom -->
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="nom" name="nom" value="{{ old('nom', $livreur->nom) }}" required>
                            @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Champ pour le téléphone -->
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="telephone" name="telephone" value="{{ old('telephone', $livreur->telephone) }}" required>
                            @error('telephone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Champ pour le type de véhicule -->
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="vehicule" name="vehicule" value="{{ old('vehicule', $livreur->vehicule) }}" required>
                            @error('vehicule') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Champ pour la disponibilité -->
                        <div class="form-group">
                            <label>Disponibilité :</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="disponibilite" id="disponible" value="1" {{ $livreur->disponibilite ? 'checked' : '' }} required>
                                <label class="form-check-label" for="disponible">Oui</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="disponibilite" id="indisponible" value="0" {{ !$livreur->disponibilite ? 'checked' : '' }} required>
                                <label class="form-check-label" for="indisponible">Non</label>
                            </div>
                            @error('disponibilite') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Champ pour la zone de couverture -->
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="zone_couverture" name="zone_couverture" value="{{ old('zone_couverture', $livreur->zone_couverture) }}" required>
                            @error('zone_couverture') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">METTRE À JOUR</button>
                        </div>

                        <!-- Lien vers une autre action, si nécessaire -->
                        <div class="text-center mt-4 font-weight-light">
                            <a href="{{ route('livreurs.index') }}" class="text-primary">Voir les livreurs</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
