@extends('layouts.admin')

@section('title', 'EMI Rules')

@section('content')

    <h1>EMI Rule List</h1>

    @if (session('message'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-left: 5px solid #28a745; margin-bottom: 15px; border-radius: 4px;">
            {{ session('message') }}
        </div>
    @endif


   {{-- Form Creation --}}
     <form action="{{ route('emi-rules.create') }}" method="POST">
        @csrf

        <label>Min Amount:</label>
        <input type="number" name="min_amount" value="{{ old('min_amount') }}">
        @error('min_amount') <div style="color: red">{{ $message }}</div> @enderror

        <br>
        <br>

        <label>Max Amount:</label>
        <input type="number" name="max_amount" value="{{ old('max_amount') }}">
        @error('max_amount') <div style="color: red">{{ $message }}</div> @enderror

        <br>
        <br>

        <label>Tenure:</label>
        <select name="tenure_id">
            <option value="">-- Select --</option>
            @foreach ($tenures as $tenure)
                <option value="{{ $tenure->id }}" {{ old('tenure_id') == $tenure->id ? 'selected' : '' }}>
                    {{ $tenure->months }} months
                </option>
            @endforeach
        </select>
        @error('tenure_id') <div style="color: red">{{ $message }}</div> @enderror

        <br><br>

        <label>Interest Rate (%):</label>
        <input type="number" name="interest_rate" step="0.01" value="{{ old('interest_rate') }}">
        @error('interest_rate') <div style="color: red">{{ $message }}</div> @enderror

        <button type="submit">Add Rule</button>
    </form>
   {{-- End Form Creation --}}
    <table border="1" style="width: 50%; text-align: center;">
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
                    <td>{{ $rule->min_amount }}</td>
                    <td>{{ $rule->max_amount }}</td>
                    <td>{{ $rule->tenure->months }}</td>
                    <td>{{ $rule->interest_rate }}</td>
                    <td>
                        <a href="{{ route('emi-rules.edit', $rule->id) }}">Edit</a>
                        <form action="{{ route('emi-rules.destroy', $rule->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this rule?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
