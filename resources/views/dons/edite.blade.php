@extends('Restaurantspace.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Modifier un don</h4>
                    <p class="card-description">
                        Mettre à jour les informations du don.
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

                    <form action="{{ route('dons.update', $don->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nourriture">Nourriture</label>
                            <select class="form-control" id="nourriture" name="nourriture_id" required>
                                <option value="" disabled {{ $don->nourriture_id == '' ? 'selected' : '' }}>Choisir une nourriture</option>
                                @foreach($nourritures as $nourriture)
                                    <option value="{{ $nourriture->id }}" {{ $don->nourriture_id == $nourriture->id ? 'selected' : '' }}>
                                        {{ $nourriture->nom }} ({{ $nourriture->type }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantité">Quantité</label>
                            <input type="number" class="form-control" id="quantité" name="quantité" value="{{ $don->quantité }}" required min="1">
                        </div>
                        <div class="form-group">
                            <label for="dateExpiration">Date d'expiration</label>
                            <input type="date" class="form-control" id="dateExpiration" name="dateExpiration" value="{{ $don->dateExpiration }}" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Statut</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="disponible" {{ $don->status == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="fini" {{ $don->status == 'fini' ? 'selected' : '' }}>Fini</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dateCollectePrevue">Date prévue pour la collecte</label>
                            <input type="date" class="form-control" id="dateCollectePrevue" name="dateCollectePrevue" value="{{ $don->dateCollectePrevue }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        <a href="{{ route('dons.index') }}" class="btn btn-secondary">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
