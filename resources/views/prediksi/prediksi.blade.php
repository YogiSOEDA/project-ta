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
                            <h1 class="m-0">Prediksi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Prediksi</li>
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
                            {{-- <div class="px-2 py-2">
                                <table>
                                    <tr>
                                        <td>Bulan</td>
                                        <td>:</td>
                                        <td>Oktober</td>
                                    </tr>
                                    <tr>
                                        <td>Tahun</td>
                                        <td>:</td>
                                        <td>2022</td>
                                    </tr>
                                </table>
                            </div> --}}
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="barang_id">Nama Barang Diramal</label>
                                                <select class="select2 form-control" id="barang_id" style="width: 100%">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="bulan_ramal">Bulan Diramal</label>
                                                <select class="select2 form-control" name="bulan_ramal" id="bulan_ramal">
                                                    <option selected disabled>Pilih Bulan</option>
                                                    <option value="1">Januari</option>
                                                    <option value="2">Februari</option>
                                                    <option value="3">Maret</option>
                                                    <option value="4">April</option>
                                                    <option value="5">Mei</option>
                                                    <option value="6">Juni</option>
                                                    <option value="7">Juli</option>
                                                    <option value="8">Agustus</option>
                                                    <option value="9">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="tahun_ramal">Tahun Diramal</label>
                                                <select class="select2 form-control" name="tahun_ramal" id="tahun_ramal"></select>
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                    </div>
                                    {{-- <table id="databarang" class="table table-bordered table-hover text-center" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Proyek</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>001</td>
                                                <td>20-10-2022</td>
                                                <td>RS Sanglah</td>
                                            </tr>
                                        </tbody>
                                    </table> --}}
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
    </div>

    <!-- REQUIRED SCRIPTS -->
    @include('template.script')

    <script>
        $(document).ready(function() {
            selectBarang();
            select2();
        });

        function selectBarang() {
            $.get("{{ url('select-barang') }}", {}, function(data, status) {
                $("#barang_id").html(data);
            })
        }

        function select2() {
            var barangSelect2 = $('#barang_id').select2();
            var bulanSelect2 = $('#bulan_ramal').select2();
            var tahunSelect2 = $('#tahun_ramal').select2();
            barangSelect2.data('select2').$selection.css('height', '1%');
            bulanSelect2.data('select2').$selection.css('height', '1%');
            tahunSelect2.data('select2').$selection.css('height', '1%');
        }
    </script>
</body>

</html>
