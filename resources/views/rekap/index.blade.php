@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Users') }}</h1>

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

<div class="row card p-5 shadow">
    <!-- DataTables Example -->
    <div class="col-md-12">
        <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Nama Pameran</th>
                    <th>Status</th>
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
        var jumlahMahasiswa = "{{$jumlahMahasiswa}}"
        var jumlahBelum = "{{ $jumlahBelum}}"

        new DataTable('#usersTable', {
            processing: true,
            serverSide: true,
            ajax: "{{ route('rekap.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'nama_pameran',
                    name: 'nama_pameran'
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false
                }
            ],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },  
                    messageBottom: `Total Mahasiswa: ${jumlahMahasiswa}\nMahasiswa Belum Pameran: ${jumlahBelum}`
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    className: 'btn btn-primary',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5] 
                    },
                    customize: function(doc) {
                        doc.content.splice(0, 0, {
                            text: `Total Mahasiswa: ${jumlahMahasiswa}\nMahasiswa Belum Pameran: ${jumlahBelum}`,
                            margin: [0, 0, 0, 12],
                            alignment: 'left'
                        });
                        doc.content[2].table.widths = ['5%', '10%', '15%', '20%', '25%', '25%'];
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    customize: function(win) {
                        $(win.document.body).prepend(`
                        <div>
                            <h3>Total Mahasiswa: ${jumlahMahasiswa}</h3>
                            <h3>Mahasiswa Belum Pameran: ${jumlahBelum}</h3>
                        </div>
                    `);
                    }
                }
            ]
        });
    });
</script>
@endsection