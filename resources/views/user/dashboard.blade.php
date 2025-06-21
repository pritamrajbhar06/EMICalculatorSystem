<!DOCTYPE html>
<html>
<head>
    <title>Loan EMI Calculator</title>
    <link rel="stylesheet" href="{{ asset('css/user/dashboard.css') }}">
</head>
<body>

<div class="calculator-container">
    <h1>Loan EMI Calculator💰 </h1>

    @if(session('emi_error'))
        <div class="error-message">
            {{ session('emi_error') }}
        </div>
    @endif

    <form action="{{ route('user.calculate') }}" method="POST">
        @csrf

        <label for="amount">Loan Amount:</label>
        <input type="text" name="amount" id="amount" value="{{ old('amount') }}" placeholder="Enter loan amount">
        <div class="field-error">
            @error('amount')
                {{ $message }}
            @enderror
        </div>

        <label for="tenure">Tenure (in months):</label>
        <select name="tenure_id" id="tenure">
            <option value="">-- Select Tenure --</option>
            @foreach ($tenures as $tenure)
                <option value="{{ $tenure->id }}" {{ old('tenure_id') == $tenure->id ? 'selected' : '' }}>
                    {{ $tenure->months }} months
                </option>
            @endforeach
        </select>
        <div class="field-error">
            @error('tenure_id')
                {{ $message }}
            @enderror
        </div>

        <button type="submit">Calculate EMI</button>
    </form>

    @if(session('emi'))
        <div class="result-box">
            <p><strong>Monthly EMI:</strong> ₹{{ session('emi') }}</p>
            <p><strong>Total Payable Amount:</strong> ₹{{ session('total') }}</p>
        </div>
    @endif
</div>

</body>
</html>
