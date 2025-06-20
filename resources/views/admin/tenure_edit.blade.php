@extends('layouts.admin')

@section('title', 'Edit Tenure')

@section('content')
    <h1>Edit Tenure</h1>
    <form action="{{ route('tenures.update', $tenure->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="months">Months:</label>
        <input type="text" name="months" id="months" value="{{ old('months', $tenure->months) }}">
        <button type="submit">Update Tenure</button>

        <div style="height: 20px; color: red;">
            @error('months')
                {{ $message }}
            @enderror
        </div>
    </form>
@endsection
