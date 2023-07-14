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
                            <h1 class="m-0">Data Barang</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Data Barang</li>
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
                                        <a href="#" class="btn btn-success" data-toggle="modal"
                                            data-target="#ModalTambahBarang">
                                            <i class="fa-solid fa-plus"></i>
                                            Tambah Barang
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="databarang" class="table table-bordered table-hover" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Gambar</th>
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
            @include('template.modal-tambah-barang')
            {{-- <div class="modal fade" id="ModalTambahBarang">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data Barang</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('storedatabarang') }}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputNamaBarang">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                            placeholder="Masukkan Nama Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputHargaBarang">Harga Barang</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa-solid fa-rupiah-sign"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="harga" name="harga"
                                                placeholder="Masukkan Harga Barang">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGambarBarang">Input Gambar</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile"
                                                    name="gambar">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                            </div>
                                        </div>
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
        </div>

        <footer class="main-footer">
            @include('template.footer')
        </footer>
    </div>
    <input type="hidden" id="table-url-barang" value="{{ route('tabelbarang') }}">
    @include('template.script')

    <script>
        $(document).ready(function() {
            $('#databarang').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': $('#table-url-barang').val()
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '10px',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar',
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
        });
    </script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

    <script src="{{ asset('js/resetmodal.js') }}"></script>
</body>

</html>
