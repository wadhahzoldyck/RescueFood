@extends('associationspace.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Modifier la Livraison</h4>
                    <p class="card-description">
                        Modifiez les détails de la livraison ci-dessous.
                    </p>

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

                    <form action="{{ route('livraison.update', $livraison->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="distribution_id">Distribution</label>
                            <select class="form-control" id="distribution_id" name="distribution_id">
                                <option value="" disabled>Choisir une distribution</option>
                                @foreach($distributions as $distribution)
                                    <option value="{{ $distribution['id'] }}" {{ $livraison->distribution_id == $distribution['id'] ? 'selected' : '' }}>
                                        {{ $distribution['nom'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $livraison->adresse) }}" >
                            @error('adresse')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date_livraison">Date de Livraison</label>
                            <input type="date" class="form-control" id="date_livraison" name="date_livraison" value="{{ old('date_livraison', $livraison->date_livraison) }}" required>
                            @error('date_livraison')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="livreur_id">Livreur</label>
                            <select class="form-control" id="livreur_id" name="livreur_id">
                                <option value="" disabled>Choisir un livreur</option>
                                @foreach($livreurs as $livreur)
                                    <option value="{{ $livreur->id }}" {{ $livraison->livreur_id == $livreur->id ? 'selected' : '' }}>
                                        {{ $livreur->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="etat">État</label>
                            <select class="form-control" id="etat" name="etat">
                                <option value="en_attente" {{ $livraison->etat == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="en_cours" {{ $livraison->etat == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="complet" {{ $livraison->etat == 'complet' ? 'selected' : '' }}>Complet</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        <a href="{{ route('livraison.index') }}" class="btn btn-secondary">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
