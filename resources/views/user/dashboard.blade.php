<!DOCTYPE html>
<html>
<head>
    <title>Loan EMI Calculator</title>
   <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #121212;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 50px 0;
        min-height: 100vh;
        color: #ddd;
    }

    .calculator-container {
        background: #1e1e1e;
        padding: 30px 40px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.6);
        width: 400px;
    }

    h1 {
        margin-bottom: 20px;
        font-size: 24px;
        text-align: center;
        color: #f0f0f0;
    }

    label {
        display: block;
        margin-top: 15px;
        font-size: 14px;
        color: #ccc;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #444;
        border-radius: 4px;
        background: #2c2c2c;
        color: #ddd;
        font-size: 14px;
    }

    input[type="text"]::placeholder {
        color: #777;
    }

    button {
        margin-top: 20px;
        width: 100%;
        background: #007bff;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background: #0056b3;
    }

    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px 12px;
        border-left: 5px solid #f5c6cb;
        margin-top: 20px;
        border-radius: 4px;
        font-size: 14px;
    }

    .result-box {
        background-color: #2e7d32;
        color: #e8f5e9;
        padding: 10px 15px;
        border-left: 5px solid #66bb6a;
        margin-top: 20px;
        border-radius: 4px;
        font-size: 15px;
    }

    .field-error {
        color: #ff5252;
        font-size: 13px;
        margin-top: 4px;
        height: 14px;
    }

    </style>
</head>
<body>

<div class="calculator-container">
    <h1>Loan EMI Calculator</h1>

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
