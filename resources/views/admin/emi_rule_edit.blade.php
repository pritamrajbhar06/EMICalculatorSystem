@extends('layouts.admin')

@section('title', 'Edit Emi Rule')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/emi_rule-edit.css') }}">
@endpush
@section('content')
    <h1>Edit EMI Rule</h1>

    <div class="form-container">
        <form action="{{ route('emi-rules.update', $emiRule->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="min_amount">Min Amount:</label>
            <input type="text" name="min_amount" id="min_amount" value="{{ old('min_amount', $emiRule->min_amount) }}">
            <div class="error-message">
                @error('min_amount')
                    {{ $message }}
                @enderror
            </div>

            <label for="max_amount">Max Amount:</label>
            <input type="text" name="max_amount" id="max_amount" value="{{ old('max_amount', $emiRule->max_amount) }}">
            <div class="error-message">
                @error('max_amount')
                    {{ $message }}
                @enderror
            </div>

            <label for="tenure_id">Tenure:</label>
            <select name="tenure_id" id="tenure_id">
                @foreach ($tenures as $tenure)
                    <option value="{{ $tenure->id }}" {{ old('tenure_id', $emiRule->tenure_id) == $tenure->id ? 'selected' : '' }}>
                        {{ $tenure->months }} months
                    </option>
                @endforeach
            </select>
            <div class="error-message">
                @error('tenure_id')
                    {{ $message }}
                @enderror
            </div>

            <label for="interest_rate">Interest Rate (%):</label>
            <input type="text" name="interest_rate" id="interest_rate" value="{{ old('interest_rate', $emiRule->interest_rate) }}">
            <div class="error-message">
                @error('interest_rate')
                    {{ $message }}
                @enderror
            </div>
            <a href="{{ route('emi-rules.index') }}" style="display:inline-block;margin-bottom:16px;color:#fff;text-decoration:underline;">&larr; Back</a>&nbsp;
            <button type="submit">Update Rule</button>
        </form>
    </div>
@endsection
