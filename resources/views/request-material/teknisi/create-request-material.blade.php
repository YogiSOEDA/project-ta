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

            <form action="{{ route('storeRM') }}" method="post" enctype="multipart/form-data">
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
                                            <label>Tanggal Request</label>
                                            <div class="input-group date" id="reservationdate"
                                                data-target-input="nearest">
                                                <input type="date" class="form-control datetimepicker-input"
                                                    data-target="#reservationdate" id="input_tanggal_request"
                                                    name="input_tanggal_request" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Kebutuhan</label>
                                            <div class="input-group date" id="reservationdate"
                                                data-target-input="nearest">
                                                <input type="date" class="form-control datetimepicker-input"
                                                    data-target="#reservationdate" id="input_tanggal_kebutuhan"
                                                    name="input_tanggal_kebutuhan" required>
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
                                                onchange="qtyBarang()">
                                                {{-- onchange="barang()"> --}}
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
                                        <table class="table table-bordered table-hover text-center" width="100%"
                                            id="list-rm">
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
                                                SIMPAN RM
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

    @include('template.script')

    <script>
        $(document).ready(function() {
            select2();
            selectProyek();
            selectBarang();
            setDate();
        });

        function select2() {
            var barangSelect2 = $('#barang_id').select2();
            var proyekSelect2 = $('#proyek_id').select2();
            var jenisRequestSelect2 = $('#jenis_request').select2();
            barangSelect2.data('select2').$selection.css('height', '1%');
            proyekSelect2.data('select2').$selection.css('height', '1%');
            jenisRequestSelect2.data('select2').$selection.css('height', '1%');
        }

        function selectProyek() {
            $.get("{{ url('teknisi/request-material/select-proyek') }}", {}, function(data, status) {
                $("#proyek_id").html(data);
            })
        }

        function selectBarang() {
            $.get("{{ url('teknisi/request-material/select-barang') }}", {}, function(data, status) {
                $("#barang_id").html(data);
            })
        }

        function qtyBarang() {
            $('#input_qty').val(0);
        }

        function setDate() {
            var date = new Date();
            var formateDate = date.toISOString().substr(0, 10);
            $('#input_tanggal_request').val(formateDate);
        }

        function addRow() {
            var barang_id = $("#barang_id").val();
            var qty = $("#input_qty").val();

            var rawCount = $('#list-rm tbody tr').length;
            rawCount = rawCount + 1;

            $.ajax({
                type: "get",
                url: "{{ url('teknisi/request-material/add-row') }}",
                data: "barang_id=" + barang_id + "&qty=" + qty + "&number=" + rawCount,
                success: function(data) {
                    $("table tbody").append(data);

                    selectBarang()
                    $('#input_qty').val('');
                }
            })
        }

        function numberingTable() {
            var number = 0;
            $('#list-rm tbody tr').each(function(index, no) {
                $(no).find('.no-table').text(++number);
            });
        }

        function deleteRow(row) {
            var parent = $(row).closest('#list-rm tbody tr');
            parent.remove();

            numberingTable();
        }
    </script>
</body>

</html>
