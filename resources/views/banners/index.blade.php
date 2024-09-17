@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Banner List</h1>

    <a href="{{ route('banners.create') }}" class="btn btn-primary mb-3">Add New Banner</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banners as $banner)
            <tr>
                <td>{{ $banner->title }}</td>
                <td>{{ $banner->description }}</td>
                <td><img src="{{ asset($banner->image_path) }}" alt="banner image" width="100"></td>
                <td>{{ $banner->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('banners.toggleStatus', $banner->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-info">
                            {{ $banner->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                    <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
