@extends('Restaurantspace.layout')

@section('content')
<div class="content-wrapper p-4">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Liste des nourritures</h4>
                    <p class="card-description">Gérez vos nourritures ici.</p>

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
                        <form method="GET" action="{{ route('nourritures.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" placeholder="Rechercher par nom ou type" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Rechercher</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <a href="{{ route('nourritures.create') }}" class="btn btn-primary mb-3">Ajouter une nourriture</a>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="{{ route('nourritures.index', ['sort' => 'nom', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                                            Nom
                                            @if (request('sort') === 'nom')
                                                <i class="fas fa-sort-{{ request('order') === 'asc' ? 'up' : 'down' }}"></i>
                                            @else
                                                <i class="fas fa-sort"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('nourritures.index', ['sort' => 'type', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                                            Type
                                            @if (request('sort') === 'type')
                                                <i class="fas fa-sort-{{ request('order') === 'asc' ? 'up' : 'down' }}"></i>
                                            @else
                                                <i class="fas fa-sort"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('nourritures.index', ['sort' => 'created_at', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                                            Créé à
                                            @if (request('sort') === 'created_at')
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
                                @foreach ($nourritures as $nourriture)
                                    <tr>
                                        <td>{{ $nourriture->nom }}</td>
                                        <td>{{ $nourriture->type }}</td>
                                        <td>{{ $nourriture->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('nourritures.edit', $nourriture->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('nourritures.destroy', $nourriture->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette nourriture?');">
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
                        {{ $nourritures->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
