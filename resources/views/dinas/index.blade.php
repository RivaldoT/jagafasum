<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dinas Management</title>
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
                    <h2 class="card-title mb-0">
                        <i class="fas fa-city me-2"></i>Dinas Management
                    </h2>
                    <a href="{{ route('dinas.create') }}" class="btn btn-outline-light">
                        <i class="fas fa-plus-circle me-2"></i>Add New Dinas
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th width="10%">#</th>
                                    <th width="20%">Name</th>
                                    <th width="20%">Address</th>
                                    <th width="20%">Cities_Name</th>
                                    <th width="20%">Cities_Province</th>
                                    <th width="20%">Cities_City</th>
                                    <th width="20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dinas as $d)
                                    <tr>
                                        <td class="text-center">{{ $d->id }}</td>
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->address }}</td>
                                        <td>{{ $d->city->name }}</td>
                                        <td>{{ $d->city->province }}</td>
                                        <td>{{ $d->city->city }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('dinas.edit', $d->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('dinas.destroy', $d->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">
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

        <!-- Bootstrap 5 JS (optional) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>