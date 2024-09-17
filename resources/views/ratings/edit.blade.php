@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Edit Rating</h1>

    <form action="{{ route('ratings.update', $rating->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="count">Rating (1-5)</label>
            <input type="number" name="count" id="count" class="form-control" value="{{ $rating->count }}" min="1" max="5">
        </div>

        <div class="form-group">
            <label for="opinion">Opinion (Optional)</label>
            <textarea name="opinion" id="opinion" class="form-control">{{ $rating->opinion }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Rating</button>
    </form>
@endsection
