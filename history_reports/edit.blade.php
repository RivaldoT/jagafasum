@extends('layouts.app')

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
</head>

@section('content')

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0"><i class="fas fa-edit me-2"></i>Edit Laporan</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('laporan.update', $laporan->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="warga" class="form-label">Nama Warga</label>
                                <input type="text" class="form-control" id="warga" value="{{ $laporan->warga->nama }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="fasilitas" class="form-label">Fasilitas</label>
                                <input type="text" class="form-control" id="fasilitas" value="{{ $laporan->fasilitas->nama }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ $laporan->deskripsi }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="Dikerjakan" @if($laporan->status == 'Dikerjakan') selected @endif>Dikerjakan</option>
                                    <option value="Selesai" @if($laporan->status == 'Selesai') selected @endif>Selesai</option>
                                    <option value="Belum Dikerjakan" @if($laporan->status == 'Belum Dikerjakan') selected @endif>Belum Dikerjakan</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection