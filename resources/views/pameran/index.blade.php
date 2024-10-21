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
<div class="row card p-5 shadow">
    @if(Auth::user()->role == 'admin')

    <a href="{{ route('pameran.data_mahasiswa') }}" class="btn btn-primary mb-2">Rekap Pameran Mahasiswa</a>
    @endif
    <!-- DataTables Example -->
    <div class="col-md-12">
        <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Judul</th>
                    <th>Jurusan</th>
                    <th>Published Date</th>
                    <th>Tahun Lulus</th>

                    <th>Actions</th>
                    <th class="hidden">Abstract</th>
                    <th class="hidden">Files</th>
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
        var base = '{{url("")}}' + '{{Storage::url("public/")}}';
        var sub = '{{$submittedCount}}'
        var notsub = '{{$notSubmittedCount}}'
        var tot = '{{$totalCount}}'
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
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'jurusan.name',
                        name: 'jurusan',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'user.tahun.tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'abstract',
                        name: 'abstract',
                        visible: false,
                        searchable: false
                    },
                    {
                        data: 'files',
                        name: 'files',
                        visible: false,
                        searchable: false
                    },
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'pdf',
                        className: 'btn btn-primary',
                        text: 'PDF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        
                        exportOptions: {

                            format: {
                                body: function(data, row, column, node) {
                                    text = `Sudah Mengumpulkan \t: ${sub} \nBelum Mengumpulkan \t:${notsub} \nTotal Mahasiswa \t: ${tot}`

                                    if (column === 8) { // The hidden files column
                                        if (Array.isArray(data)) {
                                            return data.map(file => $(`<a href="${base + file.path}">`).text(base + file.path).html()).join(', ');
                                        } else if (data && typeof data === 'object') {
                                            return data.path;
                                        }
                                    }
                                    return data
                                }
                            },
                            columns: [0, 1, 2, 3, 4, 5, 7, 8]
                        }
                    },
                    
                ]
            });
    })
</script>
@endsection