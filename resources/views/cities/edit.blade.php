@extends('layout')

@section('title', 'Edit City')

@section('content')
<h2>Edit City</h2>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7fc;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 50%;
        margin: 50px auto;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    label {
        font-weight: bold;
        margin-bottom: 8px;
        display: inline-block;
    }

    input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        margin-top: 10px;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>

<div class="container">
    <form action="{{ route('cities.update', $city->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">City Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $city->name }}" required>
        </div>

        <div class="mb-3">
            <label for="province" class="form-label">Province:</label>
            <input type="text" name="province" id="province" class="form-control" value="{{ $city->province }}" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City:</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ $city->city }}" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Update</button>
        <a href="{{ route('cities.index') }}" class="btn btn-secondary w-100">Cancel</a>
    </form>
</div>
@endsection