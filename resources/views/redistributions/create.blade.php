@extends('associationspace.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Créer une Redistribution</h4>
                    <p class="card-description">
                        Remplissez les détails pour créer une nouvelle redistribution.
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

                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('redistributions.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input 
                                type="date" 
                                class="form-control @error('date') is-invalid @enderror" 
                                id="date" 
                                name="date" 
                                value="{{ old('date') }}" 
                            >
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Statut</label>
                            <select 
                                class="form-control @error('status') is-invalid @enderror" 
                                id="status" 
                                name="status" 
                            >
                                @foreach (App\Models\Redistribution::STATUSES as $status)
                                    <option value="{{ $status }}" 
                                        {{ old('status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="beneficiaire_id">Bénéficiaire</label>
                            <select 
                                class="form-control @error('beneficiaire_id') is-invalid @enderror" 
                                id="beneficiaire_id" 
                                name="beneficiaire_id" 
                            >
                                @foreach ($beneficiaires as $beneficiaire)
                                    <option value="{{ $beneficiaire->id }}" 
                                        {{ old('beneficiaire_id') == $beneficiaire->id ? 'selected' : '' }}>
                                        {{ $beneficiaire->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('beneficiaire_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Créer</button>
                        <a href="{{ route('redistributions.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
