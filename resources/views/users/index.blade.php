<!DOCTYPE html>
<html lang="en">

    <body>
        @if (session('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Manage Users</title>
            <!-- Bootstrap 5 CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <!-- Font Awesome for icons -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
                rel="stylesheet">

        </head>

        <div class="container-fluid py-4">
            <div class="card card-custom shadow-lg border-0">
                <div
                    class="card-header bg-gradient-danger text-white d-flex justify-content-between align-items-center py-3">
                    <h2 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i>User Management
                    </h2>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th width="10%">#</th>
                                    <th width="30%">Name</th>
                                    <th width="30%">Email</th>
                                    <th width="30%">Role</th>
                                    <th width="30%">Dinas</th>
                                    <th width="30%">Address</th>
                                    <th width="30%">City</th>
                                    <th width="30%">Created At</th>
                                    <th width="30%">Updated At</th>
                                    <th width="20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->dinas->name ?? '-' }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->city->province }} - {{ $user->city->name }} -
                                            {{ $user->city->city }}
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure to Delete the User Data? Other Data Related is not deleted')">
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

            .bg-gradient-danger {
                background: linear-gradient(45deg, #e74a3b 0%, #bd2130 100%);
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
