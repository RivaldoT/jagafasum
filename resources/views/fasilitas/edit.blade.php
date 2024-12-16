<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Fasilitas</title>
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
                        <i class="fas fa-edit me-2"></i>Edit Fasilitas
                    </h2>
                    <a href="{{ route('fasilitas.index') }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Fasilitas
                    </a>
                </div>
                <div class="card-body p-4">
                    <!-- Menampilkan pesan error dari session -->
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

                    <form action="{{ route('fasilitas.update', $fasilitas->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">

                            <!-- Nama Fasilitas -->
                            <div class="col-12">
                                <label for="name" class="form-label required">Nama Fasilitas</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $fasilitas->name) }}" placeholder="Nama fasilitas" required>
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" rows="3"
                                    placeholder="Deskripsi fasilitas jika ada">{{ old('description', $fasilitas->description) }}</textarea>
                            </div>

                            <!-- Dinas Pengelola -->
                            <div class="col-md-6">
                                <label for="dinas_id" class="form-label required">Dinas Pengelola</label>
                                <select name="dinas_id" id="dinas_id" class="form-select" required>
                                    <option value="" disabled>Pilih Dinas</option>
                                    @foreach ($dinas as $d)
                                        <option value="{{ $d->id }}"
                                            {{ old('dinas_id', $fasilitas->dinas_id) == $d->id ? 'selected' : '' }}>
                                            {{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sumber Dana (fund_source) -->
                            <div class="col-md-6">
                                <label for="fund_source" class="form-label required">Sumber Dana</label>
                                <select name="fund_source" id="fund_source" class="form-select" required>
                                    <option value="" disabled>Pilih Sumber Dana</option>
                                    <option value="APBN"
                                        {{ old('fund_source', $fasilitas->fund_source) == 'APBN' ? 'selected' : '' }}>
                                        APBN</option>
                                    <option value="APBD"
                                        {{ old('fund_source', $fasilitas->fund_source) == 'APBD' ? 'selected' : '' }}>
                                        APBD</option>
                                    <option value="Swasta"
                                        {{ old('fund_source', $fasilitas->fund_source) == 'Swasta' ? 'selected' : '' }}>
                                        Swasta</option>
                                </select>
                            </div>

                            <!-- Lokasi (Latitude & Longitude) -->
                            <div class="col-md-6">
                                <label for="latitude" class="form-label required">Latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-control"
                                    placeholder="Contoh: -6.200000" required
                                    value="{{ old('latitude', $fasilitas->latitude) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="longitude" class="form-label required">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control"
                                    placeholder="Contoh: 106.816666" required
                                    value="{{ old('longitude', $fasilitas->longitude) }}">
                            </div>

                            <!-- Luasan -->
                            <div class="col-12">
                                <label for="luasan" class="form-label required">Luasan</label>
                                <input type="text" name="luasan" id="luasan" class="form-control"
                                    placeholder="Contoh: 100 m²" required
                                    value="{{ old('luasan', $fasilitas->luasan) }}">
                            </div>

                            <!-- Gambar -->
                            <div class="col-12">
                                <label for="image" class="form-label">Gambar (Kosongkan jika tidak ingin
                                    mengganti)</label>
                                <input type="file" name="image" id="image" class="form-control"
                                    accept="image/*">
                                @if ($fasilitas->image)
                                    <small class="text-muted">Gambar saat ini: <a
                                            href="{{ asset($fasilitas->image) }}" target="_blank">Lihat
                                            Gambar</a></small>
                                @endif
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status" class="form-label required">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="" disabled>Pilih Status</option>
                                    <option value="Baik"
                                        {{ old('status', $fasilitas->status) == 'Baik' ? 'selected' : '' }}>Baik
                                    </option>
                                    <option value="Rusak"
                                        {{ old('status', $fasilitas->status) == 'Rusak' ? 'selected' : '' }}>Rusak
                                    </option>
                                </select>
                            </div>

                            <!-- Kategori (Multi-select) -->
                            <div class="col-md-6">
                                <label for="categories" class="form-label required">Kategori</label>
                                <select name="categories[]" id="categories" class="form-select" multiple required>
                                    @php
                                        $selectedCategories = old(
                                            'categories',
                                            $fasilitas->categories->pluck('id')->toArray(),
                                        );
                                    @endphp
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ in_array($cat->id, $selectedCategories) ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Pilih setidaknya satu kategori. Tahan tombol Ctrl (Windows)
                                    atau Command (Mac) untuk memilih lebih dari satu.</small>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Fasilitas
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Bootstrap 5 JS (optional) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
