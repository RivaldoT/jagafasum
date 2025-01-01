<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add New Reports</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f4f6f9;
                min-height: 100vh;
                margin: 0;
                padding: 20px;
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
                <h1 class="text-center mb-4">Add New Reports</h1>
                <form action="{{ route('report.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="warga" class="form-label fw-bold"><i class="fas fa-user me-2"></i>Nama
                            Warga</label>
                        <select class="form-select" id="warga" name="warga_id" required>
                            <option value="" disabled selected>Pilih Warga</option>
                            @if (auth()->user()->role == 'Pimpinan')
                                @foreach ($wargas as $warga)
                                    <option value="{{ $warga->id }}" data-domisili="{{ $warga->domisili }}"
                                        data-city="{{ $warga->city->id }}">
                                        {{ $warga->name }} ({{ $warga->city->name }})
                                    </option>
                                @endforeach
                            @else
                                <option value="{{ auth()->user()->id }}" data-domisili="{{ auth()->user()->domisili }}"
                                    data-city="{{ auth()->user()->city->id }}" selected readonly>
                                    {{ auth()->user()->name }} ({{ auth()->user()->city->name }})
                                </option>
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fasilitas" class="form-label required">Fasilitas</label>
                        <select name="fasilitas[]" id="fasilitas" class="form-select" multiple required>
                            @foreach ($fasilitas as $fas)
                                <option value="{{ $fas->id }}">{{ $fas->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Pilih setidaknya satu kategori. Tahan tombol Ctrl (Windows)
                            atau Command (Mac) untuk memilih lebih dari satu.</small>
                    </div>


                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold"><i
                                class="fas fa-comment-alt me-2"></i>Deskripsi
                            Aduan</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan aduan Anda..."
                            required></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Save Reports</button>
                    </div>

                    <div class="back-link">
                        <a href="{{ route('report.index') }}" class="text-muted">
                            <small>Back to Report List</small>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form');
                form.addEventListener('submit', function(e) {
                    const wargaId = document.querySelector('select[name="warga_id"]').value;
                    if (!wargaId) {
                        e.preventDefault();
                        alert('Please select a warga');
                    }
                });
            });
        </script>

    </body>

</html>
