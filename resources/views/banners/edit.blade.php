@extends('layouts.admin')

@section('main-content')
<h1 class="h3 mb-4 text-gray-800">Edit Banner</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">Banner Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $banner->title) }}" required>
    </div>

    <div class="form-group">
        <label for="description">Banner Description (Optional)</label>
        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $banner->description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="image_path">Banner Image</label><br>
        @if($banner->image_path)
        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Current Banner Image" width="200" class="img-thumbnail mb-2">
        @endif
        <input type="file" name="image_path" id="image_path" class="form-control-file">
        <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
    </div>

    <button type="submit" class="btn btn-primary">Update Banner</button>
    <a href="{{ route('banners.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection