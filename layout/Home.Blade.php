<!DOCTYPE html>
<html lang="en">

<head>
    <title>Village Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">JagaFasum</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="Cities" class="nav-link">Cities</a></li>
                    <li class="nav-item"><a href="Categories" class="nav-link">Categories</a></li>
                    <li class="nav-item"><a href="facility" class="nav-link">facility</a></li>
                    <li class="nav-item"><a href="Report" class="nav-link">Report</a></li>
                    <li class="nav-item"><a href="history_reports" class="nav-link">history_reports</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-dark text-white text-center py-5">
        <div class="container">
            <h1 class="display-5 fw-bold">JagaFasum</h1>
            <img src="{{ asset('assets/images/umum.png') }}" alt="Community" style="width: 100%; max-width: 600px; height: auto;">
            <p class="lead">make you and me feel comfortable.</p>
        </div>
    </section>


    <!-- Content Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm">
                        <img src="....." class="card-img-top" alt="Inspirer">
                        <div class="card-body text-center">
                            <h5 class="card-title">Gambar A</h5>
                            <p class="card-text text-muted">Fasilitas A</p>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm">
                        <img src="....." class="card-img-top" alt="Community Help">
                        <div class="card-body text-center">
                            <h5 class="card-title">Gambar B</h5>
                            <p class="card-text text-muted">Fasilitas B</p>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm">
                        <img src="....." class="card-img-top" alt="Landlord">
                        <div class="card-body text-center">
                            <h5 class="card-title">Gambar C</h5>
                            <p class="card-text text-muted">Fasilitas C</p>
                        </div>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm">
                        <img src="....." class="card-img-top" alt="Sister Grace">
                        <div class="card-body text-center">
                            <h5 class="card-title">Gambar D</h5>
                            <p class="card-text text-muted">Fasilitas D</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 Village Community Project. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>