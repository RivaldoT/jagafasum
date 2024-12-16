<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add New Fasilitas</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f4f6f9;
                min-height: 100vh;
                margin: 0;
                padding: 20px;
            }

            .card-custom {
                border-radius: 15px;
                overflow: hidden;
            }

            .bg-gradient-success {
                background: linear-gradient(45deg, #1cc88a 0%, #13855f 100%);
            }

            .form-label {
                font-weight: 600;
                color: #495057;
            }

            .form-control,
            .form-select {
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .form-control:focus,
            .form-select:focus {
                border-color: #007bff;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            .btn-primary {
                border-radius: 8px;
                padding: 10px 20px;
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }

            .back-link {
                margin-top: 15px;
                text-align: center;
            }

            .required::after {
                content: " *";
                color: red;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid py-4">
            <div class="card card-custom shadow-lg border-0">
                <div
                    class="card-header bg-gradient-success text-white d-flex justify-content-between align-items-center py-3">
                    <h2 class="card-title mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Fasilitas
                    </h2>
                    <a href="{{ route('fasilitas.index') }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Fasilitas
                    </a>
                </div>
                <div class="card-body p-4">
                    <!-- Menampilkan pesan error dari session (misal dengan('error', 'Terjadi kesalahan')) -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Menampilkan error validasi -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi kesalahan!</strong> Silahkan cek form dibawah ini:
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">

                            <!-- Nama Fasilitas -->
                            <div class="col-12">
                                <label for="name" class="form-label required">Nama Fasilitas</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Nama fasilitas" required>
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" rows="3"
                                    placeholder="Deskripsi fasilitas jika ada"></textarea>
                            </div>

                            <!-- Dinas Pengelola -->
                            <div class="col-md-6">
                                <label for="dinas_id" class="form-label required">Dinas Pengelola</label>
                                <select name="dinas_id" id="dinas_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Dinas</option>
                                    @foreach ($dinas as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sumber Dana (fund_source) -->
                            <div class="col-md-6">
                                <label for="fund_source" class="form-label required">Sumber Dana</label>
                                <select name="fund_source" id="fund_source" class="form-select" required>
                                    <option value="" disabled selected>Pilih Sumber Dana</option>
                                    <option value="APBN">APBN</option>
                                    <option value="APBD">APBD</option>
                                    <option value="Swasta">Swasta</option>
                                </select>
                            </div>

                            <!-- Lokasi (Latitude & Longitude) -->
                            <div class="col-md-6">
                                <label for="latitude" class="form-label required">Latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-control"
                                    placeholder="Contoh: -6.200000" required>
                            </div>
                            <div class="col-md-6">
                                <label for="longitude" class="form-label required">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control"
                                    placeholder="Contoh: 106.816666" required>
                            </div>
                            <!-- Luasan -->
                            <div class="col-12">
                                <label for="luasan" class="form-label required">Luasan</label>
                                <input type="text" name="luasan" id="luasan" class="form-control"
                                    placeholder="Contoh: 100 m²" required>
                            </div>

                            <!-- Gambar -->
                            <div class="col-12">
                                <label for="image" class="form-label required">Gambar</label>
                                <input type="file" name="image" id="image" class="form-control"
                                    accept="image/*" required>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status" class="form-label required">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>

                            <!-- Kategori (Multi-select) -->
                            <div class="col-md-6">
                                <label for="categories" class="form-label required">Kategori</label>
                                <select name="categories[]" id="categories" class="form-select" multiple required>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Pilih setidaknya satu kategori. Tahan tombol Ctrl (Windows)
                                    atau Command (Mac) untuk memilih lebih dari satu.</small>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Fasilitas
                                </button>
                            </div>
                    </form>

                </div>
            </div>
        </div>


        <!-- Bootstrap 5 JS (optional) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
