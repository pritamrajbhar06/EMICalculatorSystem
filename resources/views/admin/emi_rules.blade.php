@extends('layouts.admin')

@section('title', 'EMI Rules')

@section('content')
<style>
     .emi-rules-container {
        display: flex;
        align-items: flex-start;
        gap: 30px;
        margin-top: 30px;
    }

    .form-section {
        flex: 0 0 350px;
    }

    .listing-section {
        flex: 1;
        overflow-x: auto;
    }

    .listing-section table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .listing-section th, .listing-section td {
        border: 1px solid #444;
        padding: 10px;
        text-align: center;
    }

    .listing-section th {
        background-color: #007bff;
        color: #fff;
    }


    .form-container {
        background: #1e1e1e;
        padding: 20px;
        border-radius: 6px;
    }

    .form-container label {
        display: block;
        margin-bottom: 6px;
        color: #eee;
    }

    .form-container input[type="text"],
    .form-container select {
        width: 95%;
        padding: 8px;
        margin-bottom: 12px;
        border-radius: 4px;
        border: 1px solid #444;
        background: #333;
        color: #ddd;
    }

    .form-container button {
        background: #007bff;
        color: #fff;
        padding: 10px 14px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
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
        width: 1000px;
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
        border: 1px solid #444;
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

    <h1>EMI Rules Management</h1>

    @if (session('message'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-left: 5px solid #28a745; margin-bottom: 15px; border-radius: 4px;width: 50%;">
            {{ session('message') }}
        </div>
    @endif

    <div class="emi-rules-container">
    <div class="form-section">
        <!-- your existing form here -->
        <div class="form-container">
            <form action="{{ route('emi-rules.create') }}" method="POST">
                @csrf
                <label for="min_amount">Min Amount:</label>
                <input type="text" name="min_amount" value="{{ old('min_amount') }}">

                <label for="max_amount">Max Amount:</label>
                <input type="text" name="max_amount" value="{{ old('max_amount') }}">

                <label for="tenure_id">Tenure:</label>
                <select name="tenure_id">
                    <option value="">-- Select Tenure --</option>
                    @foreach($tenures as $tenure)
                        <option value="{{ $tenure->id }}">{{ $tenure->months }} months</option>
                    @endforeach
                </select>

                <label for="interest_rate">Interest Rate (%):</label>
                <input type="text" name="interest_rate" value="{{ old('interest_rate') }}">

                <button type="submit">Add Rule</button>
            </form>
        </div>
    </div>

    <div class="listing-section">
        <h2>EMI Rules Listing:</h2>
        <table>
            <!-- your existing table -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Min Amount</th>
                    <th>Max Amount</th>
                    <th>Tenure (Months)</th>
                    <th>Interest Rate (%)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emiRules as $rule)
                    <tr>
                        <td>{{ $rule->id }}</td>
                        <td>{{ number_format($rule->min_amount, 2) }}</td>
                        <td>{{ number_format($rule->max_amount, 2) }}</td>
                        <td>{{ $rule->tenure->months }}</td>
                        <td>{{ $rule->interest_rate }}</td>
                        <td>
                            <a href="{{ route('emi-rules.edit', $rule->id) }}">Edit</a>
                            <a href="{{ route('emi-rules.destroy', $rule->id) }}" onclick="return confirm('Are you sure you want to delete this rule?');">Delete</a>                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
