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

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    {{-- <div class="float-sm-right">
                                        <a href="#" class="btn btn-success"><i class="fa-solid fa-plus"></i>Tambah Data</a>
                                    </div> --}}
                                </div>
                                <div class="card-body">
                                    <table id="purchase-order" class="table table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Jenis Task</th>
                                                <th>Proyek</th>
                                                <th>Validasi Direktur</th>
                                                <th>Validasi Akunting</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    {{-- <div class="float-sm-right">
                                        <a href="#" class="btn btn-success"><i class="fa-solid fa-plus"></i>Tambah Data</a>
                                    </div> --}}
                                </div>
                                <div class="card-body">
                                    <table id="purchase-order-acc" class="table table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Jenis Task</th>
                                                <th>Proyek</th>
                                                <th>Validasi Direktur</th>
                                                <th>Validasi Akunting</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @include('template.modal-komentar')
        </div>

        <footer class="main-footer">
            @include('template.footer')
        </footer>
    </div>

    @include('template.script')

    <script>
        $(document).ready(function() {
            table();
            table2();

            $('#close').on('click', function() {
                $('#keterangan').val('');
            })

            // var btnClose = $('#close');

            // btnClose.addEventListener('click', () => {
            //     $('#keterangan').val('');
            // })
        });

        function table() {
            $('#purchase-order').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': "{{ url('direktur/purchase-order/tabelpo') }}"
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
                        name: 'proyek.name_proyek'
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    className: 'dt-center',
                    targets: '_all'
                }],
            });
        }
        function table2() {
            $('#purchase-order-acc').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': "{{ url('direktur/purchase-order/tabelpoacc') }}"
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
                        name: 'proyek.name_proyek'
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    className: 'dt-center',
                    targets: '_all'
                }],
            });
        }

        function decline(id) {
            $("#ModalKomentar").modal('show');
            $('#id_po').val(id);
        }

        function cancel() {
            $('#keterangan').val('');
            $('#ModalKomentar').modal('hide');
        }

    </script>
</body>

</html>
