@extends('layouts.app')

<head>

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
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0"><i class="fas fa-pen-alt me-2"></i>Form Pelaporan</h5>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Success Alert
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif -->

                        <!-- Form -->
                        <form action="{{ route('laporan.store') }}" method="POST">
                            @csrf

                            <!-- Warga -->
                            <div class="mb-3">
                                <label for="warga" class="form-label fw-bold"><i class="fas fa-user me-2"></i>Nama Warga</label>
                                <select class="form-select" id="warga" name="warga_id" required>
                                    <option value="" disabled selected>Pilih Warga</option>
                                    @foreach($wargas as $warga)
                                    <option value="{{ $warga->id }}" data-domisili="{{ $warga->domisili }}">
                                        {{ $warga->nama }} ({{ $warga->domisili }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Fasilitas -->
                            <div class="mb-3">
                                <label for="fasilitas" class="form-label fw-bold"><i class="fas fa-building me-2"></i>Fasilitas</label>
                                <select class="form-select" id="fasilitas" name="fasilitas_id" required>
                                    <option value="" disabled selected>Pilih Fasilitas</option>
                                </select>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-bold"><i class="fas fa-comment-alt me-2"></i>Deskripsi Aduan</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan aduan Anda..." required></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-paper-plane me-2"></i>Kirim Laporan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.querySelector('#warga').addEventListener('change', function() {
            const domisili = this.selectedOptions[0].getAttribute('data-domisili');
            fetch('{{ route("laporan.loadFasilitas") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        domisili
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    const fasilitasSelect = document.querySelector('#fasilitas');
                    fasilitasSelect.innerHTML = '<option value="" disabled selected>Pilih Fasilitas</option>';
                    data.forEach(fasilitas => {
                        fasilitasSelect.innerHTML += `<option value="${fasilitas.id}">${fasilitas.nama}</option>`;
                    });
                });
        });
    </script>

</body>

@endsection