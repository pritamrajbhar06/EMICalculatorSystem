@extends('layouts.admin')

@section('title', 'Tenure List')

@section('content')

<style>
    .message-box {
        background-color: #d4edda;
        color: #155724;
        padding: 12px 16px;
        border-left: 5px solid #28a745;
        margin-bottom: 20px;
        border-radius: 5px;
        width: 500px;
    }
    .form-container {
        margin-top: 40px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 6px;
        width: 500px;
    }
    .form-container label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: bold;
    }
    .form-container input[type="text"] {
        width: 100%;
        padding: 8px 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .form-container button {
        background: #007bff;
        color: #fff;
        border: none;
        padding: 10px 16px;
        border-radius: 4px;
        cursor: pointer;
    }
    .form-container button:hover {
        background: #0056b3;
    }
    .error-text {
        color: red;
        font-size: 13px;
        margin-top: 4px;
    }
    h1 {
        margin-top: 40px;
        margin-bottom: 20px;
        font-size: 22px;
        color: #333;
    }
    table {
        width: 500px;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table thead th {
        background: #007bff;
        color: #fff;
        padding: 10px;
        border: 1px solid #ccc;
    }
    table tbody td {
        padding: 10px;
        border: 1px solid #ccc;
    }
    table a {
        margin: 0 5px;
        text-decoration: none;
        color: #007bff;
    }
    table a:hover {
        text-decoration: underline;
    }
</style>

@if (session('message'))
    <div class="message-box">
        {{ session('message') }}
    </div>
@endif

<div class="form-container">
    <form action="{{ route('tenures.create') }}" method="POST">
        @csrf
        <label for="months">Months:</label>
        <input type="text" name="months" id="months" value="{{ old('months') }}">
        <div class="error-text">
            @error('months')
                {{ $message }}
            @enderror
        </div>
        <button type="submit">Add Tenure</button>
    </form>
</div>

<h1>Tenure Listing</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Months</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tenures as $tenure)
            <tr>
                <td>{{ $tenure->id }}</td>
                <td>{{ $tenure->months }}</td>
                <td>
                    <a href="{{ route('tenures.edit', $tenure->id) }}">Edit</a>
                    <a href="{{ route('tenures.destroy', $tenure->id) }}"
                        onclick="return confirm('{{ $tenure->emiRules->count() > 0 ? 'This tenure is used in ' . $tenure->emiRules->count() . ' EMI rule(s). Deleting it will also delete them. Are you sure?' : 'Are you sure you want to delete this tenure?' }}')">
                        Delete
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
