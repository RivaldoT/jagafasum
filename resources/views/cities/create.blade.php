<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add New City</title>
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
                <h1 class="text-center mb-4">Add New City</h1>
                <form action="{{ route('cities.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <input type="text" name="province" id="province" class="form-control"
                            placeholder="Enter province name" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">City Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Enter city name" required>
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">City Details</label>
                        <input type="text" name="city" id="city" class="form-control"
                            placeholder="Enter city details" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Save City</button>
                    </div>

                    <div class="back-link">
                        <a href="{{ route('cities.index') }}" class="text-muted">
                            <small>Back to Cities List</small>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bootstrap 5 JS (optional) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
