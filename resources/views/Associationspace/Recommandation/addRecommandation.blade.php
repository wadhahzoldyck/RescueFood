@extends('Associationspace.layout')

@section('content')
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-6 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    
                    <h4>Nouvelle recommandation ?</h4>
                    <h6 class="font-weight-light">Remplissez simplement les informations suivantes pour soumettre votre recommandation.</h6>
                    
                    <form class="pt-3" action="{{ route('recommandations.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                        <label for="nourriture">Nourriture</label>
                            <select class="form-control" id="nourriture" name="nourriture_id" required>
                                <option value="" disabled selected>Choisir une nourriture</option>
                                @foreach($nourritures as $nourriture)
                                    <option value="{{ $nourriture->id }}">{{ $nourriture->nom }} ({{ $nourriture->type }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="titre" name="titre" placeholder="Titre de la recommandation" required>
                            @error('titre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                       
                        <div class="form-group">
                            <textarea class="form-control form-control-lg" id="description" name="description" rows="4" placeholder="Description de la recommandation" required></textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                       
                        <div class="form-group">
                            <select class="form-control form-control-lg" id="categorie" name="categorie" required>
                                <option value="">Sélectionner une catégorie</option>
                                <option value="gestion_stock">Gestion des stocks</option>
                                <option value="conservation_alimentaire">Conservation alimentaire</option>
                                <option value="recette_anti_gaspillage">Recette anti-gaspillage</option>
                            </select>
                            @error('categorie')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                       
                        <div class="form-group">
                            <select class="form-control form-control-lg" id="priorite" name="priorite" required>
                                <option value="">Sélectionner la priorité</option>
                                <option value="1">Haute</option>
                                <option value="2">Moyenne</option>
                                <option value="3">Basse</option>
                            </select>
                            @error('priorite')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                       
                        <div class="mt-3">
                            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">ENREGISTRER</button>
                        </div>

                        <div class="text-center mt-4 font-weight-light">
                            <a href="list_recommandations.html" class="text-primary">Voir les recommandations</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
