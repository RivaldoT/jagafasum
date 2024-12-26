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
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                    <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div> -->
                @endif

                <div class="card shadow-lg border-0">
                    <!-- Card Header -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0"><i class="fas fa-list me-2"></i>Daftar Laporan</h5>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Warga</th>
                                    <th>Fasilitas</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Waktu Pelaporan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporans as $laporan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $laporan->user->name ?? 'User tidak ditemukan' }}</td>
                                        <td>
                                            @forelse($laporan->fasilitas as $fasilitas)
                                                <span class="badge bg-secondary">{{ $fasilitas->name }}</span>
                                            @empty
                                                <span class="text-muted">Tidak ada fasilitas terkait</span>
                                            @endforelse
                                        </td>
                                        <td>{{ Str::limit($laporan->description, 50, '...') }}</td>
                                        <td>
                                            <span class="badge 
                                        @if($laporan->status == 'Selesai') bg-success 
                                        @elseif($laporan->status == 'Dikerjakan') bg-primary 
                                            @else bg-warning 
                                        @endif">
                                                {{ $laporan->status }}
                                            </span>
                                        </td>
                                        <td>{{ $laporan->created_at }}</td>
                                        <td class="text-center">
                                            <!-- harusnya gk bisa edit bisanya update status -->
                                            <a href="{{ route('report.edit', $laporan->id) }}"
                                                class="btn btn-warning btn-sm me-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('report.destroy', $laporan->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Tidak ada laporan tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
@endsection