<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Dinas</title>
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
            <div class="form-container">
                <h1 class="text-center mb-4">Edit Dinas</h1>
                <form action="{{ route('dinas.update', $dinas->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Dinas Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Dinas Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $dinas->name }}" placeholder="Enter Dinas name" required>
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control"
                            value="{{ $dinas->address }}" placeholder="Enter address" required>
                    </div>

                    <!-- City -->
                    <div class="mb-3">
                        <label for="city_id" class="form-label">City</label>
                        <select name="city_id" id="city_id" class="form-control" required>
                            <option value="" disabled>Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    {{ $dinas->city_id == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }} - ({{ $city->province }} / {{ $city->city }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Save Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update Dinas</button>
                    </div>

                    <!-- Back Link -->
                    <div class="back-link">
                        <a href="{{ route('dinas.index') }}" class="text-muted">
                            <small>Back to Dinas List</small>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bootstrap 5 JS (optional) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
