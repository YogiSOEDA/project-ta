<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.head')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('template.navbar')
        @include('template.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Satuan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Satuan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
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
                                    <table id="data-satuan" class="table table-bordered table-hover" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Satuan</th>
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

            @include('satuan.modal-tambah-satuan')

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

        function create() {
            $.get("{{ url('satuan/create') }}", {}, function(data, status) {
                $("#modal-page").html(data);
                $("#ModalSatuan").modal('show');
            });
        }

        function store() {
            var satuan = $("#input_nama_satuan").val();
            $.ajax({
                type: "get",
                url: "{{ url('satuan/store') }}",
                data: "satuan=" + satuan,
                success: function(data) {
                    $("#close").click();
                    Swal.fire({
                                    title: "Berhasil!",
                                    text: "Data berhasil disimpan",
                                    icon: "success"
                                });
                    $('#data-satuan').DataTable().ajax.reload();
                }

            })
        }

        function table() {
            $('#data-satuan').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': "{{ url('satuan/tabel') }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '10px',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
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

        function show(id) {
            $.get("{{ url('satuan/show') }}/" + id, {}, function(data, status) {
                $("#modal-page").html(data);
                $("#modal-title").html('Update Satuan');
                $("#ModalSatuan").modal('show');
            });
        }

        function update(id) {
            var satuan = $("#input_nama_satuan").val();
            $.ajax({
                type: "get",
                url: "{{ url('satuan/update') }}/" + id,
                data: "satuan=" + satuan,
                success: function(data) {
                    $("#close").click();
                    Swal.fire({
                                    title: "Berhasil!",
                                    text: "Data berhasil disimpan",
                                    icon: "success"
                                });
                    $('#data-satuan').DataTable().ajax.reload();
                }

            })
        }
    </script>
</body>

</html>
