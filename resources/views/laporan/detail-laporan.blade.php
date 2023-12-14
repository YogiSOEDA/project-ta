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
                            <h1 class="m-0">Laporan Pemakaian Barang Proyek {{ $proyek->nama_proyek }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Laporan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="conten">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                {{-- <label>Tanggal</label> --}}
                                                <div class="input-group date" id="reservationdate"
                                                    data-target-input="nearest">
                                                    <input type="date" class="form-control datetimepicker-input"
                                                        data-target="#reservationdate" id="input_tanggal_awal"
                                                        name="input_tanggal_awal" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <h4 class="text-center">s/d</h4>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group date" id="reservationdate"
                                                data-target-input="nearest">
                                                <input type="date" class="form-control datetimepicker-input"
                                                    data-target="#reservationdate" id="input_tanggal_akhir"
                                                    name="input_tanggal_akhir" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <button class="btn btn-success btn-block" id="tombol_tampil"
                                                    onclick="tampilkanDataTertentu()">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                    Tampilkan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <table id="pemakaian-barang" class="table table-bordered table-hover text-center"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
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

        <input type="hidden" id="proyek_id" value="{{ $proyek->id }}">
        <input type="hidden" id="tabel-history-barang" value="/laporan/tabel-histori/{{ $proyek->id }}">
    </div>

    @include('template.script')

    <script>
        $(document).ready(function() {
            var url = $('#tabel-history-barang').val();

            // console.log(url);
            table(url);
        });

        function table(url) {
            // var url = $('#tabel-history-barang').val();

            $('#pemakaian-barang').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': url,
                    data: function(data) {
                        data.tgl_awal = $('#input_tanggal_awal').val();
                        data.tgl_akhir = $('#input_tanggal_akhir').val();
                    },
                    // 'data': function(data) {
                    //     // data.tgl_awal =
                    // }
                },
                columns: [{
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
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    }
                ],
                order: [[1, 'asc']],
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    className: 'dt-center',
                    targets: '_all'
                }],
            });
        }

        function tampilkanDataTertentu() {
            $('#pemakaian-barang').DataTable().ajax.reload();

            // var proyek_id = $("#proyek_id").val();
            // var tgl_awal = $("#input_tanggal_awal").val();
            // var tgl_akhir = $("#input_tanggal_akhir").val();

            // if (tgl_awal == "" || tgl_akhir == "") {
            //     alert("Both date required");
            // } else {
            //     $('#pemakaian-barang').DataTable().destroy();
            //     fetch(tgl_awal, tgl_akhir);
            // }

            // $.ajax({
            //     type: "get",
            //     url: "{{ url('laporan/tabel-histori-search') }}",
            //     data: "tgl_awal=" + tgl_awal + "&tgl_akhir=" + tgl_akhir + "&proyek_id=" + proyek_id,
            //     success: function(data) {
                    // $('#pemakaian-barang').dataTable().fnClearTable();
                    // $('#pemakaian-barang').dataTable().fnDraw();
                    // $('#pemakaian-barang').dataTable().fnDestroy();
                    // $('#pemakaian-barang').DataTable().clear().draw();
                    // $('#pemakaian-barang').DataTable({
                    //     // destroy: true,
                    //     ordering: true,
                    //     serverSide: true,
                    //     processing: true,
                    //     data: data,
                    //     columns: [{
                    //             data: 'DT_RowIndex',
                    //             name: 'DT_RowIndex',
                    //             width: '10px',
                    //             orderable: false,
                    //             searchable: false
                    //         },
                    //         {
                    //             data: 'tanggal'
                    //             name: 'tanggal'
                    //         },
                    //         {
                    //             data: 'nama_barang',
                    //             name: 'nama_barang'
                    //         },
                    //         {
                    //             data: 'jumlah',
                    //             name: 'jumlah'
                    //         }
                    //     ],
                    //     responsive: true,
                    //     autoWidth: false,
                    //     columnDefs: [{
                    //         className: 'dt-center',
                    //         targets: '_all'
                    //     }],
                    // });

        //             console.log(data);
        //         }
        //     })
        }
    </script>
</body>

</html>
