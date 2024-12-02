@extends('layout')

@section('title', 'Dashboard')

<head>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>
@section('content')

<body>


    <!-- Dashboard Container -->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2>Welcome to the Management System JagaFasum Dashboard</h2>
                <p class="lead text-muted">Manage users, categories, facilities, cities, reports, and more from this central dashboard.</p>
            </div>
        </div>

        <div class="row">
            <!-- Users Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">Manage all users of the system.</p>
                        <a href="{{ route('users.index') }}" class="btn btn-primary">View Users</a>
                    </div>
                </div>
            </div>

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
        </div>

        <div class="row">
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
                        <a href="{{ route('reports.index') }}" class="btn btn-danger">View Reports</a>
                    </div>
                </div>
            </div>

            <!-- History Reports Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fas fa-history fa-3x text-dark mb-3"></i>
                        <h5 class="card-title">History Reports</h5>
                        <p class="card-text">Track historical report changes.</p>
                        <a href="{{ route('history-reports.index') }}" class="btn btn-info">View History Reports</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

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

    /* Icon Styling */
    .fas {
        color: #007bff;
    }

    .fas.fa-users {
        color: #17a2b8;
    }

    .fas.fa-tags {
        color: #ffc107;
    }

    .fas.fa-building {
        color: #28a745;
    }

    .fas.fa-city {
        color: #17c2f5;
    }

    .fas.fa-file-alt {
        color: #dc3545;
    }

    .fas.fa-history {
        color: #343a40;
    }

    /* Padding for the top of the page */
    .container-fluid {
        padding-top: 50px;
    }

    /* Shadow for the cards */
    .card.shadow-sm {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .card-body {
            padding: 2rem;
        }

        .card-title {
            font-size: 1.1rem;
        }

        .card-text {
            font-size: 0.9rem;
        }
    }
</style>
@endsection