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
                            <h1 class="m-0">History Prediksi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Prediksi</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <table id="history-prediksi" class="table table-bordered hover text-center" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Bulan Tahun</th>
                                                <th>Total Pengeluaran</th>
                                                <th>Total WMA</th>
                                                <th>Total Error</th>
                                                <th>Total MAD</th>
                                                <th>Total MSE</th>
                                                <th>Total MAPE</th>
                                                <th>Tanggal Create</th>
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
            </div>
        </div>

        <footer class="main-footer">
            @include('template.footer')
        </footer>
    </div>

    <input type="hidden" id="tabel-url" value="/prediksi/tabel-histori/{{ $id_barang }}">

    @include('template.script')

    <script>
        $(document).ready(function() {
            // var url = $('#tabel-url').val();
            // console.log($('#tabel-url').val());
            // $('#tabel-url').val();
            table();
        });

        function table() {
            var url = $('#tabel-url').val();
            $('#history-prediksi').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': url
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
                        data: 'bulan_tahun',
                        name: 'bulan_tahun'
                    },
                    {
                        data: 'total_pengeluaran',
                        name: 'total_pengeluaran'
                    },
                    {
                        data: 'wma',
                        name: 'wma'
                    },
                    {
                        data: 'total_error',
                        name: 'total_error'
                    },
                    {
                        data: 'total_mad',
                        name: 'total_mad'
                    },
                    {
                        data: 'total_mse',
                        name: 'total_mse'
                    },
                    {
                        data: 'total_mape',
                        name: 'total_mape'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
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
