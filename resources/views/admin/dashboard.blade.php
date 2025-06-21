@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')
    <div class="dashboard-container">
        <h1>Welcome to Admin Dashboard</h1>
        <p class="date">Today: {{ now()->format('d M, Y') }}</p>

        <div class="cards">
            <div class="card">
                <h3>Total Tenures</h3>
                <p>{{ $tenuresCount }}</p>
                <a href="{{ route('tenures.index') }}">Manage Tenures</a>
            </div>

            <div class="card">
                <h3>Total EMI Rules</h3>
                <p>{{ $emiRulesCount }}</p>
                <a href="{{ route('emi-rules.index') }}">Manage EMI Rules</a>
            </div>

            <div class="card">
                <h3>Loan Calculator</h3>
                <p>Use Calculator</p>
                <a href="{{ route('user.dashboard') }}">Go to Calculator</a>
            </div>
        </div>
    </div>
@endsection
