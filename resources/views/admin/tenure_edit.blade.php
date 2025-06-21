@extends('layouts.admin')

@section('title', 'Edit Tenure')

@section('content')
    <style>
        .edit-tenure-container {
            max-width: 400px;
            margin-top: 40px;
            padding: 30px;
            background: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.6);
        }
        h1 {
            color: #f0f0f0;
            font-size: 22px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #ccc;
            font-size: 14px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            background: #2c2c2c;
            color: #ddd;
            border: 1px solid #444;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 14px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .error-message {
            color: #ff5252;
            font-size: 13px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>

    <div class="edit-tenure-container">
        <h1>Edit Tenure</h1>

        <form action="{{ route('tenures.update', $tenure->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="months">Months:</label>
            <input type="text" name="months" id="months" value="{{ old('months', $tenure->months) }}">
            @error('months')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit">Update Tenure</button>
        </form>
    </div>
@endsection
