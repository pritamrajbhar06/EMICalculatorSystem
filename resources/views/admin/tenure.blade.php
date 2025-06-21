@extends('layouts.admin')

@section('title', 'Tenure List')

@section('content')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/tenure.css') }}">
@endpush

@if (session('message'))
    <div class="message-box">
        {{ session('message') }}
    </div>
@endif

<div class="tenure-container">
    <div class="form-section">
        <div class="form-container-tenure">
            <h1>Add Tenure</h1>
            <form action="{{ route('tenures.create') }}" method="POST">
                @csrf
                <label for="months">Months:</label>
                <input type="text" name="months" id="months" value="{{ old('months') }}">
                <div class="error-text">@error('months') {{ $message }} @enderror</div>
                <button type="submit">Add Tenure</button>
            </form>
        </div>
    </div>

    <div class="listing-section">
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
    </div>
</div>


@endsection
