@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Manage Ratings</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pameran</th>
                <th>User</th>
                <th>Rating</th>
                <th>Opinion</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ratings as $rating)
                <tr>
                    <td>{{ $rating->id }}</td>
                    <td>{{ $rating->pameran->title }}</td>
                    <td>{{ $rating->user->name }}</td>
                    <td>{{ $rating->count }}</td>
                    <td>{{ $rating->opinion }}</td>
                    <td>
                        <a href="{{ route('ratings.edit', $rating->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('ratings.destroy', $rating->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this rating?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
