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
                <form action="{{ route('storePO') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header"></div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="">Jenis Request</label>
                                                <select id="jenis_request" class="form-control" name="jenis_request" required>
                                                    <option selected disabled value="">--Pilih Task--</option>
                                                    <option value="maintenance">Maintenance</option>
                                                    <option value="project">Project</option>
                                                    <option value="retail">Retail</option>
                                                </select>
                                            </div>
                                            <div class="form-group" id="select-proyek">
                                                <label>Nama Proyek</label>
                                                <select class="form-control select2" id="proyek_id" name="proyek_id"
                                                    style="width: 100%" required>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <div class="input-group date" id="reservationdate"
                                                    data-target-input="nearest">
                                                    <input type="date" class="form-control datetimepicker-input"
                                                        data-target="#reservationdate" id="input_tanggal"
                                                        name="input_tanggal" required>
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
                                            <div class="form-group">
                                                <label for="input_harga">Harga</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control money" id="input_harga"
                                                        placeholder="Masukkan Harga Barang">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="float-sm-right">
                                                    <a href="#" class="btn btn-success"
                                                        onclick="addRow()">Simpan</a>
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
                                            <table class="table table-bordered table-hover text-center" width="100%"
                                                id="list-po">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Barang</th>
                                                        <th>Qty</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4">Total</td>
                                                        <td class="totalSum money"></td>
                                                    </tr>
                                                </tfoot>
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
                </form>
            </div>

            <footer class="main-footer">
                @include('template.footer')
            </footer>
        </div>

        <!-- REQUIRED SCRIPTS -->
        @include('template.script')

        <script>
            $(document).ready(function() {
                selectProyek();
                selectBarang();
                select2();
                setDate();

                $(".money").simpleMoneyFormat();
            });

            function selectProyek() {
                $.get("{{ url('select-proyek') }}", {}, function(data, status) {
                    $("#proyek_id").html(data);
                })
            }

            function selectBarang() {
                $.get("{{ url('select-barang') }}", {}, function(data, status) {
                    $("#barang_id").html(data);
                })
            }

            function select2() {
                var barangSelect2 = $('#barang_id').select2();
                var proyekSelect2 = $('#proyek_id').select2();
                barangSelect2.data('select2').$selection.css('height', '1%');
                proyekSelect2.data('select2').$selection.css('height', '1%');
            }

            function barang() {
                var barang_id = $("#barang_id").val();
                $.ajax({
                    type: "get",
                    url: "{{ url('data-barang/show') }}/" + barang_id,
                    success: function(response) {
                        var harga = response.result.harga;
                        harga = harga.toLocaleString('en-US', {
                            valute: 'USD',
                        });
                        $('#input_harga').val(harga);
                        $('#input_qty').val(0);
                    }
                })
            }

            function setDate() {
                var date = new Date();
                var formateDate = date.toISOString().substr(0, 10);
                $('#input_tanggal').val(formateDate);
            }

            function addRow() {
                var barang_id = $("#barang_id").val();
                var qty = $("#input_qty").val();
                var harga = $("#input_harga").val();

                harga = harga.replace(/[^0-9\.]+/g, "");

                qty = parseInt(qty);
                harga = parseInt(harga);

                var jumlah = qty * harga;

                var rawCount = $('#list-po tbody tr').length;
                rawCount = rawCount + 1;

                $.ajax({
                    type: "get",
                    url: "{{ url('add-row') }}",
                    data: "barang_id=" + barang_id + "&qty=" + qty + "&harga=" + harga + "&jumlah=" + jumlah +
                        "&number=" + rawCount,
                    success: function(data) {
                        $("table tbody").append(data);
                        totalOnchangeSum();

                        $(".money").simpleMoneyFormat();

                        selectBarang();
                        $("#input_qty").val('');
                        $("#input_harga").val('');
                    }
                })
            }

            function totalSum() {
                var totalBiaya = 0;
                $('#list-po tbody tr').each(function(index) {
                    totalBiaya += $(this).children().eq(4).text() * 1;
                });

                $('.totalSum').text(totalBiaya);
            }

            function totalOnchangeSum() {
                var biaya = 'text';
                var biayaReplace = 'text';
                var biayaNumber = 0;
                var totalBiaya = 0;
                $('#list-po tbody tr').each(function(index) {
                    biaya = $(this).children().eq(4).text();
                    biayaReplace = biaya.replace(/[^0-9\.]+/g, "");
                    biayaNumber = biayaReplace*1;
                    // totalBiaya += $(this).children().eq(4).text() * 1;
                    totalBiaya += biayaNumber;
                });

                totalBiaya = totalBiaya.toLocaleString('en-US', {
                    valute: 'USD',
                });

                $('.totalSum').text(totalBiaya);
            }

            function totalHarga(row) {
                var parent = $(row).closest('#list-po tbody tr');
                var qty = parent.find('.qty').val() == "" ? 1 : parent.find('.qty').val();
                var harga = parent.find('.harga').val() == "" ? 1 : parent.find('.harga').val();
                harga = harga.replace(/[^0-9\.]+/g, "");
                var total = qty * harga;
                total = total.toLocaleString('en-US', {
                    valute: 'USD',
                });
                parent.find('.total').text(total);

                // totalSum();
                totalOnchangeSum();
            }

            function deleteRow(row) {
                var parent = $(row).closest('#list-po tbody tr');
                parent.remove();

                numberingTable();
            }

            function numberingTable() {
                var number = 0;
                $('#list-po tbody tr').each(function(index, no) {
                    $(no).find('.no-table').text(++number);
                });
            }
        </script>
    </body>

</html>
