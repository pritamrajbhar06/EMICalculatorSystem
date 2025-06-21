@extends('layouts.admin')

@section('title', 'Edit Tenure')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/tenure-edit.css') }}">
@endpush
@section('content')
  

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
            <a href="{{ route('tenures.index') }}" class="btn btn-secondary">Back</a>&nbsp;
            <button type="submit">Update Tenure</button>
        </form>
    </div>
@endsection
