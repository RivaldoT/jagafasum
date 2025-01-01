<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cities Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

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
                        <i class="fas fa-city me-2"></i>Cities Management
                    </h2>
                </div>
                @can('patch-city-permission', Auth::user())
                    <a href="{{ route('cities.create') }}" class="btn btn-outline-light">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Cities
                    </a>
                @endcan
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th width="10%">#</th>
                                <th width="20%">Province</th>
                                <th width="20%">Name</th>
                                <th width="20%">City</th>
                                @if (Gate::check('patch-city-permission', Auth::user()) || Gate::check('delete-city-permission', Auth::user()))
                                    <th width="20%">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                                <tr>
                                    <td class="text-center">{{ $city->id }}</td>
                                    <td>{{ $city->province }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->city }}</td>
                                    @if (Gate::check('patch-city-permission', Auth::user()) || Gate::check('delete-city-permission', Auth::user()))
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                @can('patch-city-permission', Auth::user())
                                                    <a href="{{ route('cities.edit', $city->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('delete-city-permission', Auth::user())
                                                    <form action="{{ route('cities.destroy', $city->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-custom {
            border-radius: 15px;
            overflow: hidden;
        }

        .bg-gradient-success {
            background: linear-gradient(45deg, #d14edfc5 0%, #b422be 100%);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
            transition: background-color 0.3s ease;
        }
    </style>

    <!-- Bootstrap 5 JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function goToDashboard() {
            window.location.href = '/';
        }
    </script>
</body>

</html>
