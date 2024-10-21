@extends('Associationspace.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Modifier une collecte</h4>
                    <p class="card-description">
                        Mettre à jour les informations de la collecte.
                    </p>

                    <!-- Flash Messages -->
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

                    <form action="{{ route('collect.update', $collection->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="dateCollecte">Date de collecte</label>
                            <input type="date" class="form-control" id="dateCollecte" name="dateCollecte" 
                                value="{{ $collection->dateCollecte }}" required>
                        </div>

                        <div class="form-group">
                            <label for="etat">État</label>
                            <select class="form-control" id="etat" name="etat" required>
                                <option value="en attente" {{ $collection->etat == 'en attente' ? 'selected' : '' }}>En attente</option>
                                <option value="confirmé" {{ $collection->etat == 'confirmé' ? 'selected' : '' }}>Confirmé</option>
                                <option value="annulé" {{ $collection->etat == 'annulé' ? 'selected' : '' }}>Annulé</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dons">Dons associés</label>
                            <select class="form-control" id="dons" name="dons[]" multiple required>
                                @foreach($dons as $don)
                                    <option value="{{ $don->id }}" 
                                        {{ in_array($don->id, $collection->listeDons->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $don->description }} - {{ $don->quantité }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        <a href="{{ route('collect.index') }}" class="btn btn-secondary">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
