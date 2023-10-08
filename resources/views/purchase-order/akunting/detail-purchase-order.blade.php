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
                                                <td id="id_po">{{ $po->id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td>:</td>
                                                <td>{{ $po->tanggal }}</td>
                                            </tr>
                                            <tr>
                                                <td>Poyek</td>
                                                <td>:</td>
                                                <td>{{ $po->proyek->nama_proyek }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <table id="detail-po" class="table table-bordered table-hover text-center mt-md-4">
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
                                                    <td>{{ $dtl->jumlah }}</td>
                                                    <td>{{ $dtl->harga }}</td>
                                                    <td></td>
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
                                @if ($po->acc_akunting == 'belum divalidasi')
                                    <div class="card-footer">
                                        <div class="float-sm-right">
                                            <a href="/akunting/purchase-order/{{ $po->id }}/acc"
                                                class="btn btn-success">
                                                <i class="fa-solid fa-check"></i> Accept
                                            </a>
                                            <a href="/akunting/purchase-order/{{ $po->id }}/decline"
                                                class="btn btn-danger">
                                                <i class="fa-solid fa-x"></i> Decline
                                            </a>
                                        </div>
                                    </div>
                                @endif
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

    <script>
        $(document).ready(function() {
            numberingTable();
            totalHarga();
            totalSum();
        });

        function numberingTable() {
            var number = 0;
            $('#detail-po tbody tr').each(function(index, no) {
                $(no).find('.no-table').text(++number);
            });
        }

        function totalHarga() {
            var qty = 0;
            var harga = 0;
            var total = 0;
            $('#detail-po tbody tr').each(function(index, no) {
                qty = $(this).children().eq(2).text();
                harga = $(this).children().eq(3).text();
                total = qty * harga;
                $(this).children().eq(4).text(total);
            });
        }

        function totalSum() {
            var totalBiaya = 0;
            $('#detail-po tbody tr').each(function(index) {
                totalBiaya += $(this).children().eq(4).text() * 1;
            });

            $('.totalSum').text(totalBiaya);
        }
    </script>
</body>

</html>
