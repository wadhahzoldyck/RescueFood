@extends('associationspace.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Modifier une Redistribution</h4>
                    <p class="card-description">
                        Modifiez les informations de la redistribution.
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

                    <form action="{{ route('redistributions.update', $redistribution->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input 
                                type="date" 
                                class="form-control @error('date') is-invalid @enderror" 
                                id="date" 
                                name="date" 
                                value="{{ $redistribution->date->format('Y-m-d') }}" 
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
                                    <option 
                                        value="{{ $status }}" 
                                        {{ $redistribution->status === $status ? 'selected' : '' }}
                                    >
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
                                    <option 
                                        value="{{ $beneficiaire->id }}" 
                                        {{ $redistribution->beneficiaire_id === $beneficiaire->id ? 'selected' : '' }}
                                    >
                                        {{ $beneficiaire->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('beneficiaire_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="collection_id">Collection</label>
                            <select 
                                class="form-control @error('collection_id') is-invalid @enderror" 
                                id="collection_id" 
                                name="collection_id" 
                            >
                                @foreach ($collections as $collection)
                                    <option value="{{ $collection->id }}" 
                                        {{ old('collection_id') == $collection->id ? 'selected' : '' }}>
                                        {{ $collection->titre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('collection_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        <a href="{{ route('redistributions.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
