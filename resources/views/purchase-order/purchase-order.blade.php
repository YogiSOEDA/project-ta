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
                            <h1 class="m-0">Purchase Order</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Purchase Order</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <div class="float-sm-right">
                                        <a href="/purchase-order/create" class="btn btn-success">
                                        {{-- <a href="{{ route('createPO') }}" class="btn btn-success"> --}}
                                            <i class="fa-solid fa-plus"></i>
                                            Tambah Data
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="purchase-order" class="table table-bordered table-hover text-center"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Jenis Task</th>
                                                <th>Proyek</th>
                                                <th>Validasi Direktur</th>
                                                <th>Validasi Akunting</th>
                                                <th>Status</th>
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
        </div>

        <footer class="main-footer">
            @include('template.footer')
        </footer>

        @include('sweetalert::alert')
    </div>

    <!-- REQUIRED SCRIPTS -->
    @include('template.script')

    <script>
        $(document).ready(function() {
            table();
        });

        function table() {
            $('#purchase-order').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': "{{ url('purchase-order/tabelpo') }}"
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '10px',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'jenis_request',
                        name: 'jenis_request'
                    },
                    {
                        data: 'proyek.nama_proyek',
                        name: 'proyek.nama_proyek'
                    },
                    {
                        data: 'stat_dir',
                        name: 'stat_dir'
                    },
                    {
                        data: 'stat_akt',
                        name: 'stat_akt'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [[1, 'desc']],
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    className: 'dt-center',
                    targets: '_all'
                }],
            });
        }

        function create() {
            $.get("{{ url('purchase-order/create') }}", {}, function(data, status) {
                $("#modal-page").html(data);
                $("#ModalPO").modal('show');
            })
        }

        function store() {
            var proyek_id = $("#proyek_id").val();
            var tanggal = $("#input_tanggal").val();
            $.ajax({
                type: "get",
                url: "{{ url('purchase-order/store') }}",
                data: "proyek_id=" + proyek_id + "&tanggal=" + tanggal,
                success: function(data) {
                    $('#close').click();
                }
            })
        }

    </script>
</body>

</html>
