<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Report</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f4f6f9;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
            }

            .form-container {
                background-color: white;
                margin: 50px auto;
                border-radius: 12px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 30px;
                width: 100%;
                max-width: 500px;
            }

            .form-label {
                font-weight: 600;
                color: #495057;
            }

            .form-control {
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .form-control:focus {
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
        </style>
    </head>

    <body>
        <div class="container">
            <div class="form-container">
                <h1 class="text-center mb-4">Edit Report</h1>
                <form action="{{ route('report.update', $laporan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Fasilitas -->
                    <div class="mb-3">
                        <label for="fasilitas" class="form-label fw-bold">
                            <i class="fas fa-building me-2"></i>Fasilitas
                        </label>
                        <select class="form-select" id="fasilitas" name="fasilitas[]" multiple required>
                            @foreach ($fasilitas as $item)
                                <option value="{{ $item->id }}"
                                    {{ in_array($item->id, $laporan->fasilitas->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Pilih satu atau lebih fasilitas dengan menekan tombol Ctrl
                            (atau
                            Command di Mac).</small>
                    </div>


                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">
                            <i class="fas fa-comment-alt me-2"></i>Deskripsi Aduan
                        </label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan aduan Anda..."
                            required>{{ $laporan->description }}</textarea>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">
                            <i class="fas fa-tasks me-2"></i>Status
                        </label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Antri" {{ $laporan->status == 'Antri' ? 'selected' : '' }}>Antri
                            </option>
                            <option value="Dikerjakan" {{ $laporan->status == 'Dikerjakan' ? 'selected' : '' }}>
                                Dikerjakan</option>
                            <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>
                                Selesai</option>
                            <option value="Tidak terselesaikan"
                                {{ $laporan->status == 'Tidak terselesaikan' ? 'selected' : '' }}>Tidak
                                terselesaikan</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-warning w-100">
                        <i class="fas fa-check-circle me-2"></i>Update Laporan
                    </button>

                    <div class="back-link">
                        <a href="{{ route('report.index') }}" class="text-muted">
                            <small>Back to Report List</small>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bootstrap 5 JS (optional) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
