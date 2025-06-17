<form action="{{ route('user.calculate') }}" method="POST">
    @csrf
    <div>
        <label for="amount">Loan Amount:</label>
        <input type="number" name="amount" id="amount" required min="1" step="any">
    </div>
    <div>
        <label for="tenure">Tenure (in months):</label>
        <select name="tenure" id="tenure" required>
            <option value="">Select Tenure</option>
            <option value="12">12 Months</option>
            <option value="24">24 Months</option>
            <option value="36">36 Months</option>
            <option value="48">48 Months</option>
            <option value="60">60 Months</option>
        </select>
    </div>
    <button type="submit">Calculate EMI</button>
</form>