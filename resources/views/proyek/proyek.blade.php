<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.head')
</head>

<body>
    <div class="wrapper">
        @include('template.navbar')
        @include('template.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Proyek</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Data Proyek</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fuid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <div class="float-sm-right">
                                        <button class="btn btn-success" onclick="create()">
                                            <i class="fa-solid fa-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="dataproyek" class="table table-bordered table-hover" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Proyek</th>
                                                <th>CP Proyek</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @include('proyek.modal-tambah-proyek');

        </div>

        <footer class="main-footer">
            @include('template.footer')
        </footer>
    </div>
    @include('template.script')

    <script>
        $(document).ready(function() {
            table();
        });

        function table() {

            $('#dataproyek').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': "{{ url('dataproyek/tabelproyek') }}"//$('#table-url-proyek').val() //"{{ url('dataproyek/tabelproyek') }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '10px',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_proyek',
                        name: 'nama_proyek'
                    },
                    {
                        data: 'cp_proyek',
                        name: 'cp_proyek',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    className: 'dt-center',
                    targets: '_all'
                }],
            });
        }

        function create() {
            $.get("{{ url('dataproyek/create') }}", {}, function(data, status) {
                $("#modal-page").html(data);
                $("#ModalProyek").modal('show');
            });
        }

        function store() {
            var nama_proyek = $("#input_nama_proyek").val();
            var cp_proyek = $("#input_cp_proyek").val();
            $.ajax({
                type: "get",
                url: "{{ url('dataproyek/store') }}",
                data: "nama_proyek=" + nama_proyek + "&cp_proyek=" + cp_proyek,
                success: function(data) {
                    $("#close").click();
                    $('#dataproyek').DataTable().ajax.reload();
                }

            })
        }

        function show(id) {
            $.get("{{ url('dataproyek/show') }}/" + id, {}, function(data, status) {
                $("#modal-page").html(data);
                $("#modal-title").html('Update Proyek');
                $("#ModalProyek").modal('show');
            });
        }

        function update(id) {
            var nama_proyek = $("#input_nama_proyek").val();
            var cp_proyek = $("#input_cp_proyek").val();
            $.ajax({
                type: "get",
                url: "{{ url('dataproyek/update') }}/" + id,
                data: "nama_proyek=" + nama_proyek + "&cp_proyek=" + cp_proyek,
                success: function(data) {
                    $("#close").click();
                    $('#dataproyek').DataTable().ajax.reload();
                }

            })
        }
    </script>

</body>

</html>
