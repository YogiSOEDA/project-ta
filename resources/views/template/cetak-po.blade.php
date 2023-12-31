<!DOCTYPE html>
<html lang="en">
<head>
    @include('template.head')
</head>
<body>
    <div id="cetak">

        <div class="text-center">
            <img src="/img/logo.png" alt="Alam Raya">
        </div>
        {{-- hallo --}}
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
                                                    <td>{{ $tgl }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Poyek</td>
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
                                                        <td class="money">{{ $dtl->harga }}</td>
                                                        <td class="money"></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4">Total</td>
                                                    <td class="totalSum money"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
    </div>

    @include('template.script')

    <script>
        $(document).ready(function() {
            numberingTable();
            totalHarga();
            totalSum();

            $(".money").simpleMoneyFormat();
            window.print();
            // $('#cetak').print();
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
