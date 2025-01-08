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
    </head>

    <body>
        @if (Auth::user()->role !== 'Warga')
            <div class="container-fluid py-4">
                <!-- Main Card -->
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
                        <!-- Filter Tabs -->
                        <ul class="nav nav-tabs" id="filterTabs" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="all-reports-tab" data-bs-toggle="tab"
                                    data-bs-target="#all-reports" type="button" role="tab">
                                    Semua Laporan
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="damaged-facilities-tab" data-bs-toggle="tab"
                                    data-bs-target="#damaged-facilities" type="button" role="tab">
                                    Fasilitas Rusak
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="unresolved-reports-tab" data-bs-toggle="tab"
                                    data-bs-target="#unresolved-reports" type="button" role="tab">
                                    Laporan Belum Selesai
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="top-reporters-tab" data-bs-toggle="tab"
                                    data-bs-target="#top-reporters" type="button" role="tab">
                                    Warga Paling Aktif
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content mt-3" id="filterTabsContent">
                            <!-- All Reports -->
                            <div class="tab-pane fade show active" id="all-reports" role="tabpanel">
                                <h4 class="mb-3">Semua Laporan</h4>
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Warga</th>
                                            <th>Fasilitas</th>
                                            <th>Deskripsi</th>
                                            <th>Status</th>
                                            <th>Waktu Buat</th>
                                            <th>Waktu Update</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($laporans as $laporan)
                                            <tr>
                                                <td>{{ $laporan->id }}</td>
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
                                                                        @elseif($laporan->status == 'Tidak Terselesaikan') bg-danger
                                                                        @else bg-warning @endif">
                                                        {{ $laporan->status }}
                                                    </span>
                                                </td>
                                                <td>{{ $laporan->created_at }}</td>
                                                <td>{{ $laporan->updated_at }}</td>
                                                <td class="text-center">
                                                    @can('patch-report-permission', Auth::user())
                                                        <a href="{{ route('report.edit', $laporan->id) }}"
                                                            class="btn btn-warning btn-sm me-1">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete-report-permission', Auth::user())
                                                        <form action="{{ route('report.destroy', $laporan->id) }}"
                                                            method="POST" class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">Tidak ada laporan
                                                    tersedia.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Daftar fasilitas rusak -->
                            <div class="tab-pane fade" id="damaged-facilities" role="tabpanel">
                                <h4 class="mb-3">Fasilitas Rusak Berdasarkan Kategori (Bulan Tertentu)</h4>

                                <!-- Filter Bulan -->
                                <div class="mb-3">
                                    <label for="month" class="form-label">Pilih Bulan</label>
                                    <select id="month" class="form-select" onchange="updateFacilities()">
                                        <option value="1" {{ $month == 1 ? 'selected' : '' }}>Januari</option>
                                        <option value="2" {{ $month == 2 ? 'selected' : '' }}>Februari</option>
                                        <option value="3" {{ $month == 3 ? 'selected' : '' }}>Maret</option>
                                        <option value="4" {{ $month == 4 ? 'selected' : '' }}>April</option>
                                        <option value="5" {{ $month == 5 ? 'selected' : '' }}>Mei</option>
                                        <option value="6" {{ $month == 6 ? 'selected' : '' }}>Juni</option>
                                        <option value="7" {{ $month == 7 ? 'selected' : '' }}>Juli</option>
                                        <option value="8" {{ $month == 8 ? 'selected' : '' }}>Agustus</option>
                                        <option value="9" {{ $month == 9 ? 'selected' : '' }}>September</option>
                                        <option value="10" {{ $month == 10 ? 'selected' : '' }}>Oktober</option>
                                        <option value="11" {{ $month == 11 ? 'selected' : '' }}>November</option>
                                        <option value="12" {{ $month == 12 ? 'selected' : '' }}>Desember</option>
                                    </select>
                                </div>

                                <!-- Fasilitas Rusak Berdasarkan Kategori -->
                                @if ($categories->isEmpty())
                                    <p class="text-muted">Tidak ada data fasilitas rusak untuk bulan ini.</p>
                                @else
                                    <div class="accordion" id="damagedFacilitiesAccordion">
                                        @foreach ($categories as $category)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $category->id }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $category->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse{{ $category->id }}">
                                                        {{ $category->name }}
                                                        <span
                                                            class="badge bg-danger ms-2">{{ $category->fasilitas->count() }}
                                                            Rusak</span>
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $category->id }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="heading{{ $category->id }}"
                                                    data-bs-parent="#damagedFacilitiesAccordion">
                                                    <div class="accordion-body">
                                                        @if ($category->fasilitas->isEmpty())
                                                            <p class="text-muted">Tidak ada fasilitas rusak pada
                                                                kategori ini.</p>
                                                        @else
                                                            <ul class="list-group">
                                                                @foreach ($category->fasilitas as $facility)
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                                        {{ $facility->name }}
                                                                        <span
                                                                            class="badge bg-danger">{{ $facility->status }}</span>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Unresolved Reports -->
                            <div class="tab-pane fade" id="unresolved-reports" role="tabpanel">
                                <h4 class="mb-3">Laporan Belum Selesai</h4>
                                <p><strong>7 Hari Terakhir:</strong></p>
                                <ul>
                                    @foreach ($unresolved7Days as $report)
                                        <li>{{ $report->description }}</li>
                                    @endforeach
                                </ul>
                                <p><strong>14 Hari Terakhir:</strong></p>
                                <ul>
                                    @foreach ($unresolved14Days as $report)
                                        <li>{{ $report->description }}</li>
                                    @endforeach
                                </ul>
                                <p><strong>1 Bulan Terakhir:</strong></p>
                                <ul>
                                    @foreach ($unresolved30Days as $report)
                                        <li>{{ $report->description }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Top Reporters -->
                            <div class="tab-pane fade" id="top-reporters" role="tabpanel">
                                <h4 class="mb-3">5 Warga Paling Aktif Melapor</h4>
                                <ul>
                                    @foreach ($topReporters as $reporter)
                                        <li>{{ $reporter->name }} - {{ $reporter->reports_count }} laporan</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container-fluid py-4">
                <!-- Main Card -->
                <div class="card card-custom shadow-lg border-0">
                    <div
                        class="card-header bg-gradient-success text-white d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center">
                            <button onclick="goToDashboard()" class="btn btn-outline-light me-3">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                            <h2 class="card-title mb-0">
                                <i class="fas fa-list me-2"></i>Laporan Saya
                            </h2>
                        </div>
                        <a href="{{ route('report.create') }}" class="btn btn-outline-light">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Laporan
                        </a>
                    </div>

                    <div class="card-body p-4">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>ID Laporan</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Waktu Buat</th>
                                    <th>Waktu Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporans as $laporan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $laporan->id }}</td>
                                        <td>{{ Str::limit($laporan->description, 50, '...') }}</td>
                                        <td>
                                            <span
                                                class="badge
                                                        @if ($laporan->status == 'Selesai') bg-success
                                                        @elseif($laporan->status == 'Dikerjakan') bg-primary
                                                        @elseif($laporan->status == 'Tidak Terselesaikan') bg-danger
                                                        @else bg-warning @endif">
                                                {{ $laporan->status }}
                                            </span>
                                        </td>
                                        <td>{{ $laporan->created_at }}</td>
                                        <td>{{ $laporan->updated_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Tidak ada laporan tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif



        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function goToDashboard() {
                window.location.href = '/';
            }

            function updateFacilities() {
                const selectedMonth = document.getElementById('month').value;
                const url = new URL(window.location.href);
                url.searchParams.set('month', selectedMonth);
                window.location.href = url.toString();
            }
        </script>
    </body>

</html>
