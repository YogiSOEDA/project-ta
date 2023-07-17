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

        function previewImage() {
            const image = document.querySelector('#input_image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>

    <script src="{{ asset('js/resetmodal.js') }}"></script>
</body>

</html>
