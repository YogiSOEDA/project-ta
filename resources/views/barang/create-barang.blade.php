<form action="/data-barang/store" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="inputNamaBarang">Nama Barang</label>
        <input type="text" class="form-control" id="input_nama_barang" name="nama_barang"
            placeholder="Masukkan Nama Barang" required>
    </div>
    <div class="form-group" id="select-satuan">
        <label>Nama Satuan</label>
        <select class="form-control select2" id="satuan_id" name="satuan_id" style="width: 100%" required>
        </select>
    </div>
    <div class="form-group">
        <label for="inputHargaBarang">Harga Barang</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-solid fa-rupiah-sign"></i>
                </span>
            </div>
            <input type="number" class="form-control" id="input_harga" name="harga"
                placeholder="Masukkan Harga Barang" required>
        </div>
    </div>
    <div class="form-group">
        <label for="inputGambarBarang">Input Gambar</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="input_image" name="gambar"
                    onchange="previewImage()">
                <label class="custom-file-label" for="input_image">Choose
                    file</label>
            </div>
            <img class="img-preview img-fluid mb-3">
        </div>
    </div>
    <div class="form-group">
        <div class="float-sm-right">
            <button class="btn btn-success" type="submit">Simpan</button>
            {{-- <button class="btn btn-success" type="submit" onclick="store()">Simpan</button> --}}
        </div>
    </div>
</form>


{{-- EXPERIMEN --}}
{{-- <!DOCTYPE html>
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

            <form action="{{ route('storeBarang') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputNamaBarang">Nama Barang</label>
                                            <input type="text" class="form-control" id="input_nama_barang"
                                                name="nama_barang" placeholder="Masukkan Nama Barang">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputGambarBarang">Input Gambar</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="input_image"
                                                        name="gambar" onchange="previewImage()">
                                                    <label class="custom-file-label" for="input_image">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <img class="img-preview img-fluid mb-3">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <label for="">Input Jenis Barang</label>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputJenis">Jenis/Type Barang</label>
                                            <input type="text" class="form-control" id="input_jenis_barang"
                                                name="jenis_barang" placeholder="Masukkan Jenis Barang">
                                        </div>
                                        <div class="form-group">
                                            <div class="text-right">
                                                <a href="#" class="btn btn-success" onclick="addRowType()">Simpan</a>
                                            </div>
                                        </div>

                                        <table class="table table-bordered hover text-center" id="list-jenis-barang"
                                            width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Jenis/Type Barang</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <label for="">Input Ukuran Barang</label>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputUkuran">Ukuran Barang</label>
                                            <input type="text" class="form-control" id="input_ukuran_barang"
                                                name="ukuran_barang" placeholder="Masukkan Ukuran Barang">
                                        </div>
                                        <div class="form-group">
                                            <div class="text-right">
                                                <a href="#" class="btn btn-success" onclick="addRowUkuran()">Simpan</a>
                                            </div>
                                        </div>

                                        <table class="table table-bordered hover text-center" id="list-ukuran-barang"
                                            width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Ukuran Barang</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <button class="btn btn-success btn-block" type="submit">
                                            SIMPAN BARANG
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>

        <footer class="main-footer">
            @include('template.footer')
        </footer>
    </div>

    @include('template.script')

    <script>
        function previewImage() {
            const image = document.querySelector('#input_image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.classList.add("col-sm-3");
            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function addRowType() {
            var jenis_barang = $('#input_jenis_barang').val();

            var rawCount = $('#list-jenis-barang tbody tr').length;
            rawCount = rawCount + 1;

            $.ajax({
                type: "get",
                url: "{{ url('data-barang/add-row-type') }}",
                data: "jenis_barang=" + jenis_barang + "&number=" + rawCount,
                success: function(data) {
                    $("#list-jenis-barang tbody").append(data);

                    $("#input_jenis_barang").val("");
                }
            })
        }

        function numberingTableType() {
            var number = 0;
            $('#list-jenis-barang tbody tr').each(function(index, no) {
                $(no).find('.no-table').text(++number);
            });
        }

        function deleteRowType(row) {
            var parent = $(row).closest('#list-jenis-barang tbody tr');
            parent.remove();

            numberingTableType();
        }

        function addRowUkuran() {
            var ukuran_barang = $('#input_ukuran_barang').val();

            var rawCount = $('#list-ukuran-barang tbody tr').length;
            rawCount = rawCount + 1;

            $.ajax({
                type: "get",
                url: "{{ url('data-barang/add-row-ukuran') }}",
                data: "ukuran_barang=" + ukuran_barang + "&number=" + rawCount,
                success: function(data) {
                    $('#list-ukuran-barang tbody').append(data);

                    $('#input_ukuran_barang').val("");
                }
            })
        }

        function numberingTableUkuran() {
            var number = 0;
            $('#list-ukuran-barang tbody tr').each(function(index, no) {
                $(no).find('.no-table').text(++number);
            });
        }

        function deleteRowUkuran(row) {
            var parent = $(row).closest('#list-ukuran-barang tbody tr');
            parent.remove();

            numberingTableUkuran();
        }
    </script>
</body>

</html> --}}
