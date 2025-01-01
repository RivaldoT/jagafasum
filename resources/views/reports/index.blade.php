<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

<style>
    .card-custom {
        border-radius: 15px;
        overflow: hidden;
    }

    .bg-gradient-success {
        background: linear-gradient(45deg, #c8391c 0%, #851b13 100%);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.075);
        transition: background-color 0.3s ease;
    }
</style>

<body>
    <div class="container-fluid py-4">
        <div class="card card-custom shadow-lg border-0">
            <div
                class="card-header bg-gradient-success text-white d-flex justify-content-between align-items-center py-3">
                <div class="d-flex align-items-center">
                    <button onclick="goToDashboard()" class="btn btn-outline-light me-3">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <h2 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i>Daftar Laporan
                    </h2>
                </div>
                @can('create-report-permission', Auth::user())
                    <a href="{{ route('report.create') }}" class="btn btn-outline-light">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Laporan
                    </a>
                @endcan
            </div>

            <div class="card-body p-4">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Nama Warga</th>
                            <th>Fasilitas</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Waktu Pelaporan</th>
                            @if (Gate::check('patch-report-permission', Auth::user()) || Gate::check('delete-report-permission', Auth::user()))
                                <th class="text-center">Actions</th>
                            @endif
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
                                    <span
                                        class="badge
                                        @if ($laporan->status == 'Selesai') bg-success
                                        @elseif($laporan->status == 'Dikerjakan') bg-primary
                                            @else bg-warning @endif">
                                        {{ $laporan->status }}
                                    </span>
                                </td>
                                <td>{{ $laporan->created_at }}</td>
                                @if (Gate::check('patch-report-permission', Auth::user()) || Gate::check('delete-report-permission', Auth::user()))
                                    <td class="text-center">
                                        @can('patch-report-permission', Auth::user())
                                            <!-- harusnya gk bisa edit bisanya update status -->
                                            <a href="{{ route('report.edit', $laporan->id) }}"
                                                class="btn btn-warning btn-sm me-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan

                                        @can('delete-report-permission', Auth::user())
                                            <form action="{{ route('report.destroy', $laporan->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada laporan tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script>
        function goToDashboard() {
            window.location.href = '/';
        }
    </script>

</body>
