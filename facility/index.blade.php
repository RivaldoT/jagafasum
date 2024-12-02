<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

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

    <div class="container-fluid py-4">
        <div class="card card-custom shadow-lg border-0">
            <div class="card-header bg-gradient-success text-white d-flex justify-content-between align-items-center py-3">
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
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fasilitas as $fasilitasItem)
                            <tr>
                                <td class="text-center">{{ $fasilitasItem->id }}</td>
                                <td>{{ $fasilitasItem->name }}</td>
                                <td>{{ $fasilitasItem->description }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $fasilitasItem->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $fasilitasItem->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('fasilitas.edit', $fasilitasItem->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('fasilitas.destroy', $fasilitasItem->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus?')">
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

@endsection