@extends('layouts.admin')

@section('title', 'Tenure List')

@section('content')
    @if (session('message'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-left: 5px solid #28a745; margin-bottom: 15px; border-radius: 4px; position: absolute; width: 500px;">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('tenures.create') }}" method="POST" style="margin-top: 50px;">
        @csrf
        <label for="months">Months:</label>
        <input type="text" name="months" id="months" value="{{ old('months') }}">
        <button type="submit">Add Tenure</button>
            <div style="height: 2px; color: red;">
                @error('months')
                    {{ $message }}
                @enderror
            </div>
    </form>
    <h1>Tenure Listing: </h1>

    <table border="1" style="width: 50%; text-align: center;">
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
                        <a href="{{ route('tenures.destroy', $tenure->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
