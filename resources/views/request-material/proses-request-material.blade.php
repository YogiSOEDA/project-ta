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

            <form action="{{ route('storeRMtoPO') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <div class="col-lg-6">
                                            <table class="text-left" width="50%">
                                                <tr>
                                                    <td>RM No.</td>
                                                    <td>:</td>
                                                    <td>
                                                        {{ $rm->id }}
                                                        <input type="hidden" name="id_rm"
                                                            value="{{ $rm->id }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jenis Task</td>
                                                    <td>
                                                        :
                                                        <input type="hidden" name="jenis_request"
                                                            value="{{ $rm->jenis_request }}">
                                                    </td>
                                                    <td style="text-transform:capitalize">{{ $rm->jenis_request }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Request</td>
                                                    <td>:</td>
                                                    <td>
                                                        {{ $rm->tanggal_request }}
                                                        <input type="hidden" class="form-control datetimepicker-input"
                                                            data-target="#reservationdate" id="input_tanggal"
                                                            name="input_tanggal" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Kebutuhan</td>
                                                    <td>:</td>
                                                    <td>{{ $rm->tanggal_kebutuhan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Proyek</td>
                                                    <td>:</td>
                                                    <td>
                                                        {{ $rm->proyek->nama_proyek }}
                                                        <input type="hidden" name="proyek_id"
                                                            value="{{ $rm->proyek_id }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>User</td>
                                                    <td>:</td>
                                                    <td>{{ $rm->user->name }}</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <table id="detail-rm"
                                            class="table table-bordered table-hover text-center mt-md-4">
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
                                            <tbody>
                                                @foreach ($detail as $item)
                                                    <tr>
                                                        <td class="no-table"></td>
                                                        <td>{{ $item->barang->nama_barang }}</td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="hidden" class="id_barang"
                                                                    name="id_barang[]" id="id_barang"
                                                                    value="{{ $item->barang_id }}">
                                                                <input type="number" class="form-control qty"
                                                                    name="qty[]" value="{{ $item->jumlah }}"
                                                                    onchange="totalHargaOnChange(this)">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control harga"
                                                                    id="harga" name="harga[]"
                                                                    value="{{ $item->barang->harga }}"
                                                                    onchange="totalHargaOnChange(this)">
                                                            </div>
                                                        </td>
                                                        <td class="total"></td>
                                                        <td>
                                                            <button class="btn btn-danger" onclick="deleteRow(this)">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4">Total</td>
                                                    <td class="totalSum"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-success btn-block" type="submit">
                                            PROSES PURCHASE ORDER
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

        @include('template.script')
    </div>

    <script>
        $(document).ready(function() {
            numberingTable();
            totalHarga();
            totalSum();
            setDate();
        })

        function numberingTable() {
            var number = 0;
            $('#detail-rm tbody tr').each(function(index, no) {
                $(no).find('.no-table').text(++number);
            });
        }

        function totalHarga() {
            // var qty = $('.qty').val();
            // var harga = $('.harga').val();
            // var total = $('.total');
            var total = 0;

            $('#detail-rm tbody tr').each(function(index) {
                var qty = $(this).find('.qty').val();
                var harga = $(this).find('.harga').val();
                total = qty * harga;
                $(this).find('.total').text(total);
            });

            totalSum();
        }

        function totalSum() {
            var totalBiaya = 0;
            $('#detail-rm tbody tr').each(function(index) {
                totalBiaya += $(this).children().eq(4).text() * 1;
            });

            $('.totalSum').text(totalBiaya);
        }

        function totalHargaOnChange(row) {
            var parent = $(row).closest('#detail-rm tbody tr');
            var qty = parent.find('.qty').val() == "" ? 1 : parent.find('.qty').val();
            var harga = parent.find('.harga').val() == "" ? 1 : parent.find('.harga').val();
            var total = qty * harga;
            parent.find('.total').text(total);

            totalSum();
        }

        function deleteRow(row) {
            var parent = $(row).closest('#detail-rm tbody tr');
            parent.remove();

            numberingTable();
            totalSum();
        }

        function setDate() {
            var date = new Date();
            var formateDate = date.toISOString().substr(0, 10);
            $('#input_tanggal').val(formateDate);
        }
    </script>
</body>

</html>
