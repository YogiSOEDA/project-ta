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
                            <h1 class="m-0">Request Material</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Request Material</li>
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
                                    <h5 class="m-0">Request Material Belum Diproses</h5>
                                </div>
                                <div class="card-body">
                                    <table id="request-material" class="table table-bordered hover text-center" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Request Material</th>
                                                <th>Proyek</th>
                                                <th>Tanggal Request</th>
                                                <th>Tanggal Kebutuhan</th>
                                                <th>Status</th>
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
                                    <h5 class="m-0">Request Material Sudah Diproses</h5>
                                </div>
                                <div class="card-body">
                                    <table id="request-material-done" class="table table-bordered hover text-center" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Request Material</th>
                                                <th>Proyek</th>
                                                <th>Tanggal Request</th>
                                                <th>Tanggal Kebutuhan</th>
                                                <th>Status</th>
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
        </div>
        <footer class="main-footer">
            @include('template.footer')
        </footer>

        @include('sweetalert::alert')
    </div>

    @include('template.script')

    <script>
        $(document).ready(function() {
            table();
            tableDone();
        });

        function table() {
            $('#request-material').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': "{{ url('/request-material/tabel-rm') }}"
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
                        data: 'jenis_request',
                        name: 'jenis_request'
                    },
                    {
                        data: 'proyek.nama_proyek',
                        name: 'proyek.nama_proyek'
                    },
                    {
                        data: 'tanggal_request',
                        name: 'tanggal_request'
                    },
                    {
                        data: 'tanggal_kebutuhan',
                        name: 'tanggal_kebutuhan'
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
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    className: 'dt-center',
                    targets: '_all'
                }],
            })
        }

        function tableDone() {
            $('#request-material-done').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': "{{ url('/request-material/tabel-rm-done') }}"
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
                        data: 'jenis_request',
                        name: 'jenis_request'
                    },
                    {
                        data: 'proyek.nama_proyek',
                        name: 'proyek.nama_proyek'
                    },
                    {
                        data: 'tanggal_request',
                        name: 'tanggal_request'
                    },
                    {
                        data: 'tanggal_kebutuhan',
                        name: 'tanggal_kebutuhan'
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
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    className: 'dt-center',
                    targets: '_all'
                }],
            })
        }
    </script>
</body>

</html>
