@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h2>Edit Jurusan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Jurusan Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $jurusan->name) }}" required>
        </div>

        <div class="form-group">
            <label for="code">Jurusan Code</label>
            <input type="text" name="code" class="form-control" id="code" value="{{ old('code', $jurusan->code) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
