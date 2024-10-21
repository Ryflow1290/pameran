@extends('layouts.admin')

@section('main-content')
<h1 class="h3 mb-4 text-gray-800">Manage Ratings</h1>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row card p-5 shadow">
    <!-- DataTables Example -->
    <div class="col-md-12">
        <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pameran</th>
                    <th>Nama Author</th>
                    <th>Perolehan</th>
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
        new DataTable('#usersTable', {
            processing: true,
            serverSide: true,
            ajax: "{{ route('ratings.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'likes_count',
                    name: 'likes_count',
                    orderable: true,
                    searchable: false
                }
            ],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                    // messageBottom: `Total Rating: ${jumlahRating}\nRata-Rata Rating Pameran: ${rataRata}`

                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    title: 'Rekap Perolehan Data Like Pameran Tugas Akhir Mahasiswa Politeknik Indonusa Surakarta',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    },
                    customize: function(doc) {

                      
                        doc.content[1].table.widths = ['5%', '60%', '20%', '15%'];

                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    },
                    // customize: function(win) {
                    //     $(win.document.body).prepend(`
                    //     <div>
                    //         <h3>Total Rating: ${jumlahRating}</h3>
                    //         <h3>Rata-Rata Rating Pameran: ${rataRata}</h3>
                    //     </div>
                    // `);
                    // }
                }
            ]
        });
    });
</script>
@endsection