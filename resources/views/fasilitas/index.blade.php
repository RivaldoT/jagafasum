<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fasilitas Management</title>
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
            background: linear-gradient(45deg, #1cc88a 0%, #13855f 100%);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
            transition: background-color 0.3s ease;
        }
    </style>

    <body>
        @if (session('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Menampilkan pesan error dari session (misal dengan('error', 'Terjadi kesalahan')) -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container-fluid py-4">
            <div class="card card-custom shadow-lg border-0">
                <div
                    class="card-header bg-gradient-success text-white d-flex justify-content-between align-items-center py-3">
                    <h2 class="card-title mb-0">
                        <i class="fas fa-list-alt me-2"></i>Manajemen Fasilitas
                    </h2>
                    <a href="{{ route('fasilitas.create') }}" class="btn btn-outline-light">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Fasilitas
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Luasan</th>
                                    <th>Kondisi</th>
                                    <th>Dinas Pengelola</th>
                                    <th>Asal Fasilitas</th>
                                    <th>Koordinat Lokasi Fasilitas</th>
                                    <th>Deskripsi</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fasilitas as $fasilitasItem)
                                    <tr>
                                        <td class="text-center">{{ $fasilitasItem->id }}</td>
                                        <td><img src="{{ asset($fasilitasItem->image) }}"
                                                alt="{{ $fasilitasItem->image }}">
                                        </td>
                                        <td>{{ $fasilitasItem->name }}</td>
                                        <td>
                                            @foreach ($fasilitasItem->categories as $category)
                                                <span class="badge bg-info text-dark">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $fasilitasItem->luasan }}</td>
                                        <td class="text-center">
                                            <span
                                                class="badge {{ $fasilitasItem->status == 'Baik' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $fasilitasItem->status }}
                                            </span>
                                        </td>
                                        <td>{{ $fasilitasItem->dinas->name }}</td>
                                        <td>{{ $fasilitasItem->fund_source }}</td>
                                        <td>
                                            <a href="https://maps.google.com/?q={{ $fasilitasItem->latitude }},{{ $fasilitasItem->longitude }}"
                                                target="_blank">
                                                {{ $fasilitasItem->latitude }}, {{ $fasilitasItem->longitude }}
                                            </a>
                                        </td>
                                        <td>{{ $fasilitasItem->description }}</td>
                                        <td>{{ $fasilitasItem->created_at }}</td>
                                        <td>{{ $fasilitasItem->updated_at }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('fasilitas.edit', $fasilitasItem->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('fasilitas.destroy', $fasilitasItem->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Anda yakin ingin menghapus?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </body>
