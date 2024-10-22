@extends('associationspace.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste des Redistributions</h4>
                    <p class="card-description">
                        Gérez vos redistributions ici.
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

                    <!-- Search Form -->
                    <div class="form-group">
                        <form method="GET" action="{{ route('redistributions.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" placeholder="Rechercher par bénéficiaire" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Rechercher</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <a href="{{ route('redistributions.create') }}" class="btn btn-primary mb-3">Créer une Redistribution</a>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="{{ route('redistributions.index', ['sort' => 'date', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                                            Date
                                            @if (request('sort') === 'date')
                                                <i class="fas fa-sort-{{ request('order') === 'asc' ? 'up' : 'down' }}"></i>
                                            @else
                                                <i class="fas fa-sort"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('redistributions.index', ['sort' => 'status', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                                            Statut
                                            @if (request('sort') === 'status')
                                                <i class="fas fa-sort-{{ request('order') === 'asc' ? 'up' : 'down' }}"></i>
                                            @else
                                                <i class="fas fa-sort"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Bénéficiaire</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($redistributions as $redistribution)
                                    <tr>
                                        <td>{{ $redistribution->formatted_date }}</td>
                                        <td>{{ $redistribution->status_label }}</td>
                                        <td>{{ $redistribution->beneficiaire->nom }}</td>
                                        <td>
                                            <a href="{{ route('redistributions.edit', $redistribution->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('redistributions.destroy', $redistribution->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette redistribution ?');">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination justify-content-center">
                        {{ $redistributions->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
