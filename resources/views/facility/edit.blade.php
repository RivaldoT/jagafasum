@extends('layout')
<html>

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    @yield('styles')
</head>
@section('title', 'Add Fasilitas')

@section('styles')
<style>
    .card-header {
        background-color: #007bff !important;
    }

    .btn-warning {
        transition: all 0.3s ease;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>


@section('content')

<body>

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-custom shadow-lg border-0">
                    <div class="card-header bg-gradient-warning text-dark text-center py-3">
                        <h2 class="card-title mb-0">
                            <i class="fas fa-edit me-2"></i>Edit Fasilitas
                        </h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('fasilitas.update', $fasilitas->id) }}" method="POST" class="form-floating">
                            @csrf
                            @method('PUT')
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $fasilitas->name }}" placeholder="Nama Fasilitas" required>
                                <label for="name">Nama Fasilitas</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Deskripsi Fasilitas" id="description" name="description" style="height: 120px" required>{{ $fasilitas->description }}</textarea>
                                <label for="description">Deskripsi Fasilitas</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="status" name="status" required>
                                    <option value="active" {{ $fasilitas->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ $fasilitas->status == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                <label for="status">Status Fasilitas</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-sync-alt me-2"></i>Update Fasilitas
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

</body>
@endsection