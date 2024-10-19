@extends('Restaurantspace.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ajouter nourriture</h4>
                    <p class="card-description">
                        Remplissez les détails pour créer un nouveau nourriture.

                    </p>

                    <!-- Display flash messages -->
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

                    <form action="{{ route('nourritures.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nom">Name</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="" disabled selected>Choisir un type</option>
                                <option value="Fruits">Fruits</option>
                                <option value="Légumes">Légumes</option>
                                <option value="Viande">Viande</option>
                                <option value="Poisson">Poisson</option>
                                <option value="Produits laitiers">Produits laitiers</option>
                                <option value="Pain et céréales">Pain et céréales</option>
                                <option value="Produits surgelés">Produits surgelés</option>
                                <option value="Produits en conserve">Produits en conserve</option>
                                <option value="Produits secs">Produits secs</option>
                                <option value="Produits de boulangerie">Produits de boulangerie</option>
                                <option value="Snacks">Snacks</option>
                                <option value="Boissons">Boissons</option>
                                <option value="Condiments">Condiments</option>
                                <option value="Épices">Épices</option>
                                <option value="Plats préparés">Plats préparés</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Créer nourriture</button>
                        <a href="{{ route('nourritures.index') }}" class="btn btn-secondary">fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
