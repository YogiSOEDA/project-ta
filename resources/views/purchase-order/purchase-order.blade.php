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
                                        {{-- <a href="#" class="btn btn-success" data-toggle="modal"
                                            data-target="#ModalTambahOrder">
                                            <i class="fa-solid fa-plus"></i>
                                            Tambah Data
                                        </a> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="purchase-order" class="table table-bordered table-hover text-center"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Proyek</th>
                                                <th>Validasi Direktur</th>
                                                <th>Validasi Akunting</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- <tr>
                                                <td>001</td>
                                                <td>20-10-2022</td>
                                                <td>RS Sanglah</td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- <div class="modal fade" id="ModalTambahOrder">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data Order</h5>
                            <button class="close" type="button" data-dismiss="modal" id="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('storedatabarang') }}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputNamaBarang">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            placeholder="Masukkan Tanggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputProyek">Proyek</label>
                                        <input type="text" class="form-control" id="proyek" name="proyek"
                                            placeholder="Masukkan Nama Proyek">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
            @include('purchase-order.modal-tambah-po');
        </div>
        {{-- <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside> --}}

        <footer class="main-footer">
            @include('template.footer')
        </footer>
    </div>

    <!-- REQUIRED SCRIPTS -->
    @include('template.script')

    <script>
        $.fn.modal.Constructor.prototype.enforceFocus = function() {
            $('.select2').select2();
                // dropdownParent: $('#ModalPO')
            // });
        };
        // $('.select2bs4').select2({
        //     dropdownParent: $('#ModalPO')
        // });

        // $(document).ready(function() {
        //     $('.select2bs4').select2({
        //         theme: 'bootstrap4'
        //     })
        //     $('.option-proyek').select2();
        // });

        function table() {

            $("#purchase-order").DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': "{{}}",
                },
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    width: '10px',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'proyek_id',
                    name: 'proyek_id'
                },
                {
                    data: 'acc_direktur',
                    name: 'acc_direktur'
                },
                {
                    data: 'acc_akunting',
                    name: 'acc_akunting'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
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
