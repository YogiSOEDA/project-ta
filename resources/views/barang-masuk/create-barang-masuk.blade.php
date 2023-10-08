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
                            <h1 class="m-0">Barang Masuk</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Barang Masuk</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header"></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="date" class="form-control datetimepicker-input"
                                                data-target="#reservationdate" id="input_tanggal"
                                                name="input_tanggal" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header"></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <select class="select2 form-control" id="barang_id" style="width: 100%"
                                            onchange="barang()">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="input_qty">Qty</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="input_qty"
                                                placeholder="Masukkan Jumlah Barang">
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="input_harga">Harga</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="input_harga"
                                                placeholder="Masukkan Harga Barang">
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <div class="float-sm-right">
                                            <a href="#" class="btn btn-success" onclick="addRow()">Simpan</a>
                                            {{-- <button class="btn btn-success" onclick="addRow()">Simpan</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header"></div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover text-center" id="list-bm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="float-sm-right">
                                        <button class="btn btn-success" type="submit">
                                            SIMPAN PO
                                        </button>
                                    </div>
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

    @include('template.script')
</body>

</html>
