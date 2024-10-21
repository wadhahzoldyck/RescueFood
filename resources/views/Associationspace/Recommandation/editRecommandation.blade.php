@extends('Associationspace.layout')

@section('content')
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-6 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <h4>Modifier la recommandation</h4>
                    <h6 class="font-weight-light">Modifiez simplement les informations suivantes pour mettre à jour votre recommandation.</h6>

                    <form class="pt-3" action="{{ route('recommandations.update', $recommandation->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nourriture">Nourriture</label>
                            <select class="form-control" id="nourriture" name="nourriture_id" required>
                                <option value="" disabled {{ !$recommandation->nourriture_id ? 'selected' : '' }}>
                                    Choisir une nourriture
                                </option>
                        
                                @foreach($nourritures as $nourriture)
                                    <option value="{{ $nourriture->id }}" 
                                        {{ $recommandation->nourriture_id == $nourriture->id ? 'selected' : '' }}>
                                        {{ $nourriture->nom }} ({{ $nourriture->type }})
                                    </option>
                                @endforeach
                            </select>
                        
                            @error('nourriture_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Champ pour le titre -->
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="titre" name="titre" placeholder="Titre de la recommandation" value="{{ old('titre', $recommandation->titre) }}">
                            @error('titre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Champ pour la description -->
                        <div class="form-group">
                            <textarea class="form-control form-control-lg" id="description" name="description" rows="4" placeholder="Description de la recommandation">{{ old('description', $recommandation->description) }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Champ pour la catégorie -->
                        <div class="form-group">
                            <select class="form-control form-control-lg" id="categorie" name="categorie">
                                <option value="">Sélectionner une catégorie</option>
                                <option value="gestion_stock" {{ old('categorie', $recommandation->categorie) == 'gestion_stock' ? 'selected' : '' }}>Gestion des stocks</option>
                                <option value="conservation_alimentaire" {{ old('categorie', $recommandation->categorie) == 'conservation_alimentaire' ? 'selected' : '' }}>Conservation alimentaire</option>
                                <option value="recette_anti_gaspillage" {{ old('categorie', $recommandation->categorie) == 'recette_anti_gaspillage' ? 'selected' : '' }}>Recette anti-gaspillage</option>
                            </select>
                            @error('categorie')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Champ pour la priorité -->
                        <div class="form-group">
                            <select class="form-control form-control-lg" id="priorite" name="priorite">
                                <option value="">Sélectionner la priorité</option>
                                <option value="1" {{ old('priorite', $recommandation->priorite) == 1 ? 'selected' : '' }}>Haute</option>
                                <option value="2" {{ old('priorite', $recommandation->priorite) == 2 ? 'selected' : '' }}>Moyenne</option>
                                <option value="3" {{ old('priorite', $recommandation->priorite) == 3 ? 'selected' : '' }}>Basse</option>
                            </select>
                            @error('priorite')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">METTRE À JOUR</button>
                        </div>

                        <!-- Lien vers une autre action, si nécessaire -->
                        <div class="text-center mt-4 font-weight-light">
                            <a href="{{ route('recommandations.index') }}" class="text-primary">Retourner à la liste des recommandations</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
