
@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Pameran') }}</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger border-left-danger" role="alert">
    <ul class="pl-4 my-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row my-4">
    <a href="{{route('pameran.create')}}" class="btn-primary btn">Create</a>

    </div>
<div class="row card p-4 shadow">
    
    <!-- DataTables Example -->
    <div class="col-md-12">
        <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Jurusan</th>
                    <th>Published Date</th>
                    <th>Description</th>
                 
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection

@section('scripts')
<!-- Include DataTables JS -->

<script type="text/javascript">
    $(document).ready(function() {
        new DataTable(
            '#usersTable', {
                processing: true,
                serverSide: true,
                ajax: "{{ route('pameran.data') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user.name',
                        name: 'user'
                    },
                    {
                        data: 'jurusan.name',
                        name: 'jurusan'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
    });
</script>
@endsection