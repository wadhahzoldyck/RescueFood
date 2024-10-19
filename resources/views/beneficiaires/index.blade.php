@extends('associationspace.layout')

@section('content')
<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List of Beneficiaries</h4>
                <p class="card-description">
                    Manage your beneficiaries here.
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
                
                <script>
                    // Wait 2 seconds (2000 milliseconds) before closing the alert
                    setTimeout(function() {
                        // Find the alert and trigger the dismiss (fade out and remove)
                        $('.alert').alert('close');
                    }, 2000);
                </script>

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <a href="{{ route('beneficiaires.create') }}" class="btn btn-primary mb-3">Add Beneficiary</a>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($beneficiaires as $beneficiaire)
                                <tr>
                                    <td>{{ $beneficiaire->nom }}</td>
                                    <td>{{ $beneficiaire->contact }}</td>
                                    <td>{{ $beneficiaire->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('beneficiaires.edit', $beneficiaire->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('beneficiaires.destroy', $beneficiaire->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this beneficiary?');">Delete</button>
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
