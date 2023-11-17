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
            <form action="{{ route('updatePO') }}" method="post" enctype="multipart/form-data">
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
                                                    <td>PO No.</td>
                                                    <td>:</td>
                                                    <td>{{ $po->id }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal</td>
                                                    <td>:</td>
                                                    <td>{{ $po->tanggal }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Proyek</td>
                                                    <td>:</td>
                                                    <td>{{ $po->proyek->nama_proyek }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Jenis Task</td>
                                                    <td>:</td>
                                                    <td style="text-transform:capitalize">{{ $po->jenis_request }}</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <table id="barang-po"
                                            class="table table-bordered table-hover text-center mt-md-4">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Barang</th>
                                                    <th>Qty</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($detail as $dtl)
                                                    <tr>
                                                        <td class="no-table"></td>
                                                        <td>{{ $dtl->barang->nama_barang }}</td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="hidden" class="id_detail_po"
                                                                    name="id_detail_po[]" id="id_detail_po"
                                                                    value="{{ $dtl->id }}">
                                                                <input type="number" class="form-control qty"
                                                                    id="qty" name="qty[]"
                                                                    value="{{ $dtl->jumlah }}"
                                                                    onchange="totalHarga(this)">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control harga"
                                                                    id="harga" name="harga[]"
                                                                    value="{{ $dtl->harga }}"
                                                                    onchange="totalHarga(this)">
                                                            </div>
                                                        </td>
                                                        <td class="total"></td>
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
                                        <div class="float-sm-right">
                                            <button class="btn btn-success" type="submit">
                                                SIMPAN
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
            numberingTable();
            ttlHarga();
            totalSum();
        });

        function numberingTable() {
            var number = 0;
            $('#barang-po tbody tr').each(function(index, no) {
                $(no).find('.no-table').text(++number);
            });
        }

        function ttlHarga() {
            var qty = 0;
            var harga = 0;
            var total = 0;
            $('#barang-po tbody tr').each(function(index, no) {
                qty = $(this).find('.qty').val();
                harga = $(this).find('.harga').val();
                total = qty * harga;
                $(this).children().eq(4).text(total);
            });
        }

        function totalHarga(row) {
            var parent = $(row).closest('#barang-po tbody tr');
            var qty = parent.find('.qty').val() == "" ? 1 : parent.find('.qty').val();
            var harga = parent.find('.harga').val() == "" ? 1 : parent.find('.harga').val();
            var total = qty * harga;
            parent.find('.total').text(total);

            totalSum();
        }

        function totalSum() {
            var totalBiaya = 0;
            $('#barang-po tbody tr').each(function(index) {
                totalBiaya += $(this).children().eq(4).text() * 1;
            });

            $('.totalSum').text(totalBiaya);
        }
    </script>
</body>

</html>
