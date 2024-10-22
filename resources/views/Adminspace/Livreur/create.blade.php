@extends('Adminspace.layout')

@section('content')
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-6 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                    <h4>Ajouter un Livre</h4>
                    <h6 class="font-weight-light">Remplissez le formulaire ci-dessous pour ajouter un livreur</h6>
                    <form class="pt-3" action="{{ route('livreursadmin.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Adresse email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nom -->
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="nom" name="nom" placeholder="Nom du livreur">
                            @error('nom')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Téléphone -->
                        <div class="form-group">
                            <input type="tel" class="form-control form-control-lg" id="telephone" name="telephone" placeholder="Numéro de téléphone" required>
                            @error('telephone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Véhicule -->
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="vehicule" name="vehicule" placeholder="Type de véhicule" required>
                            @error('vehicule')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Disponibilité -->


                        <!-- Zone de couverture -->
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="zone_couverture" name="zone_couverture" placeholder="Zone de couverture" required>
                            @error('zone_couverture')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="disponibilite">Disponibilité</label>
                            <input type="checkbox" id="disponibilite" name="disponibilite" value="1">
                            @error('disponibilite')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Bouton de soumission -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">ENREGISTRER</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
