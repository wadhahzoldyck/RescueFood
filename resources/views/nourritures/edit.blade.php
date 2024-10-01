@extends('associationspace.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">modifier nourriture</h4>
                    <p class="card-description">
                        Mettre à jour les coordonnées du nourriture.
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

                    <form action="{{ route('nourritures.update', $nourriture->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nom">Name</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $nourriture->nom }}" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="" disabled {{ $nourriture->type == '' ? 'selected' : '' }}>Choisir un type</option>
                                <option value="Fruits" {{ $nourriture->type == 'Fruits' ? 'selected' : '' }}>Fruits</option>
                                <option value="Légumes" {{ $nourriture->type == 'Légumes' ? 'selected' : '' }}>Légumes</option>
                                <option value="Viande" {{ $nourriture->type == 'Viande' ? 'selected' : '' }}>Viande</option>
                                <option value="Poisson" {{ $nourriture->type == 'Poisson' ? 'selected' : '' }}>Poisson</option>
                                <option value="Produits laitiers" {{ $nourriture->type == 'Produits laitiers' ? 'selected' : '' }}>Produits laitiers</option>
                                <option value="Pain et céréales" {{ $nourriture->type == 'Pain et céréales' ? 'selected' : '' }}>Pain et céréales</option>
                                <option value="Produits surgelés" {{ $nourriture->type == 'Produits surgelés' ? 'selected' : '' }}>Produits surgelés</option>
                                <option value="Produits en conserve" {{ $nourriture->type == 'Produits en conserve' ? 'selected' : '' }}>Produits en conserve</option>
                                <option value="Produits secs" {{ $nourriture->type == 'Produits secs' ? 'selected' : '' }}>Produits secs</option>
                                <option value="Produits de boulangerie" {{ $nourriture->type == 'Produits de boulangerie' ? 'selected' : '' }}>Produits de boulangerie</option>
                                <option value="Snacks" {{ $nourriture->type == 'Snacks' ? 'selected' : '' }}>Snacks</option>
                                <option value="Boissons" {{ $nourriture->type == 'Boissons' ? 'selected' : '' }}>Boissons</option>
                                <option value="Condiments" {{ $nourriture->type == 'Condiments' ? 'selected' : '' }}>Condiments</option>
                                <option value="Épices" {{ $nourriture->type == 'Épices' ? 'selected' : '' }}>Épices</option>
                                <option value="Plats préparés" {{ $nourriture->type == 'Plats préparés' ? 'selected' : '' }}>Plats préparés</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">modifier nourriture</button>
                        <a href="{{ route('nourritures.index') }}" class="btn btn-secondary">fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
