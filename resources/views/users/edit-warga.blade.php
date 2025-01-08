<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Profile</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f4f6f9;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
            }

            .form-container {
                background-color: white;
                margin: 50px auto;
                border-radius: 12px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 30px;
                width: 100%;
                max-width: 500px;
            }

            .form-label {
                font-weight: 600;
                color: #495057;
            }

            .form-control {
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .form-control:focus {
                border-color: #007bff;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            .btn-primary {
                border-radius: 8px;
                padding: 10px 20px;
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }

            .back-link {
                margin-top: 15px;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <div class="container">
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
            <div class="form-container">
                <h1 class="text-center mb-4">Edit User Profile</h1>
                <form action="{{ route('update-profile') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $user->name }}" required>
                    </div>

                    <!-- Address Field -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control" rows="3" required>{{ $user->address }}</textarea>
                    </div>

                    <!-- City Field -->
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <select name="city" id="city" class="form-control" required>
                            <option value="" disabled>Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ $user->city_id == $city->id ? 'selected' : '' }}>
                                    {{ $city->province }} - {{ $city->name }} - {{ $city->city }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ $user->email }}" required>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password (Optional)</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Leave blank if not changing">
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" placeholder="Leave blank if not changing">
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>

                    <!-- Back Link -->
                    <div class="back-link">
                        <a href="{{ route('home-page') }}" class="text-muted">
                            <small>Back to Dashboard</small>
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </body>

</html>