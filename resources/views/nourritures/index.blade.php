@extends('associationspace.layout')

@section('content')
<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des nourritures</h4>
                <p class="card-description">
                    Gérez vos nourriture ici.
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

                <a href="{{ route('nourritures.create') }}" class="btn btn-primary mb-3">ajouter nourriture</a>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>mon</th>
                                <th>type</th>
                                <th>Créer à</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nourritures as $nourriture)
                                <tr>
                                    <td>{{ $nourriture->nom }}</td>
                                    <td>{{ $nourriture->type }}</td>
                                    <td>{{ $nourriture->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('nourritures.edit', $nourriture->id) }}" class="btn btn-warning btn-sm">modifier</a>
                                        <form action="{{ route('nourritures.destroy', $nourriture->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce nourriture?');">supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
