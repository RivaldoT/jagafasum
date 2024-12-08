@extends('layouts.app')

<head>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

@section('content')

<body>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <!-- Card Header -->
                    <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0"><i class="fas fa-edit me-2"></i>Edit Laporan</h5>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="{{ route('laporan.update', $laporan->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <!-- Fasilitas -->
                            <div class="mb-3">
                                <label for="fasilitas" class="form-label fw-bold">
                                    <i class="fas fa-building me-2"></i>Fasilitas
                                </label>
                                <select class="form-select" id="fasilitas" name="fasilitas_id" required>
                                    @foreach($fasilitas as $item)
                                    <option value="{{ $item->id }}" {{ $laporan->fasilitas_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-bold">
                                    <i class="fas fa-comment-alt me-2"></i>Deskripsi Aduan
                                </label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan aduan Anda..." required>{{ $laporan->deskripsi }}</textarea>
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold">
                                    <i class="fas fa-tasks me-2"></i>Status
                                </label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="Antri" {{ $laporan->status == 'Antri' ? 'selected' : '' }}>Antri</option>
                                    <option value="Dikerjakan" {{ $laporan->status == 'Dikerjakan' ? 'selected' : '' }}>Dikerjakan</option>
                                    <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Tidak terselesaikan" {{ $laporan->status == 'Tidak terselesaikan' ? 'selected' : '' }}>Tidak terselesaikan</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-warning w-100">
                                <i class="fas fa-check-circle me-2"></i>Update Laporan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
@endsection