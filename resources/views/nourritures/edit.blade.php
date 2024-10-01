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
                            <label for="type">type</label>
                            <input type="text" class="form-control" id="contact" name="type" value="{{ $nourriture->type }}" required>
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
