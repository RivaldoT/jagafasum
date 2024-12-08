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
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card shadow-lg border-0">
                    <!-- Card Header -->
                    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0"><i class="fas fa-history me-2"></i>History Report</h5>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Warga</th>
                                    <th>Fasilitas</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Waktu Pelaporan</th>
                                    <th>Update Terakhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporans as $laporan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $laporan->warga->nama }}</td>
                                    <td>{{ $laporan->fasilitas->nama }}</td>
                                    <td>{{ Str::limit($laporan->deskripsi, 50, '...') }}</td>
                                    <td>
                                        <span class="badge 
                                        @if($laporan->status == 'Selesai') bg-success 
                                        @elseif($laporan->status == 'Dikerjakan') bg-primary 
                                        @else bg-warning 
                                        @endif">
                                            {{ $laporan->status }}
                                        </span>
                                    </td>
                                    <td>{{ $laporan->waktu_pelaporan }}</td>
                                    <td>{{ $laporan->updated_at->format('d-m-Y H:i') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada laporan dalam riwayat.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $laporans->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
@endsection