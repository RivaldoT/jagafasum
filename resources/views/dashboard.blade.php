@extends('layouts.app')
@section('title', 'Dashboard')
@section('head')

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

@endsection

@section('content')

<body>
    @if (Auth::user()->role !== 'Warga')
        <!-- Dashboard Backoffice -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h4 class="mb-2">
                        Welcome, <span class="text-primary">{{ Auth::user()->name }}</span>
                        (Role: <span class="text-success">{{ Auth::user()->role }}</span>)
                    </h4>
                    <h2>Welcome to the Management System JagaFasum Dashboard</h2>
                    <p class="lead text-muted">Manage users, categories, facilities, cities, reports, and more from this
                        central dashboard.</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Categories Card -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body text-center">
                            <i class="fas fa-tags fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">Categories</h5>
                            <p class="card-text">Manage categories and classifications.</p>
                            <a href="{{ route('categories.index') }}" class="btn btn-warning">View Categories</a>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas Card -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body text-center">
                            <i class="fas fa-building fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Fasilitas</h5>
                            <p class="card-text">Manage facilities information.</p>
                            <a href="{{ route('fasilitas.index') }}" class="btn btn-success">View Fasilitas</a>
                        </div>
                    </div>
                </div>

                <!-- Cities Card -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body text-center">
                            <i class="fas fa-city fa-3x text-info mb-3"></i>
                            <h5 class="card-title">Cities</h5>
                            <p class="card-text">Manage city data.</p>
                            <a href="{{ route('cities.index') }}" class="btn btn-info">View Cities</a>
                        </div>
                    </div>
                </div>

                <!-- Reports Card -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body text-center">
                            <i class="fas fa-file-alt fa-3x text-danger mb-3"></i>
                            <h5 class="card-title">Reports</h5>
                            <p class="card-text">Manage reports and feedback.</p>
                            <a href="{{ route('report.index') }}" class="btn btn-danger">View Reports</a>
                        </div>
                    </div>
                </div>

                <!-- Dinas Card -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body text-center">
                            <i class="fas fa-briefcase fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Dinas</h5>
                            <p class="card-text">Manage government offices and related data.</p>
                            <a href="{{ route('dinas.index') }}" class="btn btn-primary">View Dinas</a>
                        </div>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x text-secondary mb-3"></i>
                            <h5 class="card-title">Users</h5>
                            <p class="card-text">Manage user accounts and roles.</p>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">View Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h1>Welcome, {{ Auth::user()->name }}</h1>
                    <p class="lead">Explore Public Facilities</p>
                </div>
            </div>

            <div class="row mb-4 justify-content-center">
                <div class="col-auto">
                    <a href="{{ route('report.index') }}" class="btn btn-primary">
                        <i class="fas fa-list me-2"></i>Laporan Saya
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('report.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Laporan
                    </a>
                </div>
            </div>


            <div class="row">
                @foreach ($fasilitas as $fasilitasItem)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-0 h-100">
                            <img src="{{ asset('images/' . $fasilitasItem->image) }}" class="card-img-top rounded mb-2"
                                alt="{{ $fasilitasItem->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{ $fasilitasItem->name }}</h5>
                                <p class="card-text">
                                    <strong>Kategori:</strong>
                                    @foreach ($fasilitasItem->categories as $category)
                                        <span class="badge bg-info text-dark">{{ $category->name }}</span>
                                    @endforeach
                                </p>
                                <p class="card-text"><strong>Luasan:</strong> {{ $fasilitasItem->luasan }}</p>
                                <p class="card-text"><strong>Kondisi:</strong>
                                    <span class="badge {{ $fasilitasItem->status == 'Baik' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $fasilitasItem->status }}
                                    </span>
                                </p>
                                <p class="card-text"><strong>Pengelola:</strong> {{ $fasilitasItem->dinas->name }}</p>
                                <p class="card-text"><strong>Lokasi:</strong>
                                    <a href="https://maps.google.com/?q={{ $fasilitasItem->latitude }},{{ $fasilitasItem->longitude }}"
                                        target="_blank">
                                        Lihat di Google Maps
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</body>

<style>
    .card-body {
        padding: 3rem;
        background-color: #343a40;
        border-radius: 12px;
    }

    .card-title {
        font-weight: bold;
        color: aliceblue;
        font-size: 1.2rem;
    }

    .card-text {
        font-size: 1rem;
        color: blanchedalmond;
    }

    .btn {
        font-weight: 600;
        text-transform: uppercase;
    }

    .btn:hover {
        transform: scale(1.05);
        transition: all 0.3s ease-in-out;
    }

    .fas {
        color: #007bff;
    }

    .container-fluid {
        padding-top: 50px;
    }

    .navbar {
        margin-bottom: 20px;
    }
</style>
@endsection