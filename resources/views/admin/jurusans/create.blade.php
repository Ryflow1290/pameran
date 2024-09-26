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

    <form action="{{ route('jurusan.store') }}" method="POST">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="name">Jurusan Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="code">Jurusan Code</label>
            <input type="text" name="code" class="form-control" id="code" value="{{ old('code') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
