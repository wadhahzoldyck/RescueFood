@extends('Restaurantspace.layout')

@section('content')
<div class="content-wrapper p-4">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Liste des dons</h4>
                    <p class="card-description">Gérez vos dons ici.</p>

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

                    <div class="form-group">
                        <form method="GET" action="{{ route('dons.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" placeholder="Rechercher par quantité, statut, ou nom de nourriture" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Rechercher</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <a href="{{ route('dons.create') }}" class="btn btn-primary mb-3">Ajouter un don</a>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-dark">Nourriture</th>
                                    <th>
                                        <a href="{{ route('dons.index', ['sort' => 'quantité', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                                            Quantité
                                            @if (request('sort') === 'quantité')
                                                <i class="fas fa-sort-{{ request('order') === 'asc' ? 'up' : 'down' }}"></i>
                                            @else
                                                <i class="fas fa-sort"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('dons.index', ['sort' => 'status', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                                            Statut
                                            @if (request('sort') === 'status')
                                                <i class="fas fa-sort-{{ request('order') === 'asc' ? 'up' : 'down' }}"></i>
                                            @else
                                                <i class="fas fa-sort"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('dons.index', ['sort' => 'dateExpiration', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                                            Date d'Expiration
                                            @if (request('sort') === 'dateExpiration')
                                                <i class="fas fa-sort-{{ request('order') === 'asc' ? 'up' : 'down' }}"></i>
                                            @else
                                                <i class="fas fa-sort"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-dark">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dons as $don)
                                    <tr>
                                        <td>{{ $don->nourriture->nom }} ({{ $don->nourriture->type }})</td>

                                        <td>{{ $don->quantité }}</td>
                                        <td>{{ $don->status }}</td>
                                        <td>{{ $don->dateExpiration->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('dons.edit', $don->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('dons.destroy', $don->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce don?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination justify-content-center">
                        {{ $dons->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
