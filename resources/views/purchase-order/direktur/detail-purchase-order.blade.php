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

                                        <table id="detail-po"
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
                                    @if ($po->acc_direktur == 'belum divalidasi' && $po->status == 'belum diproses')
                                        <div class="card-footer">
                                            <div class="float-sm-right">
                                                <a href="/direktur/purchase-order/{{ $po->id }}/acc"
                                                    class="btn btn-success">
                                                    <i class="fa-solid fa-check"></i> Accept
                                                </a>
                                                {{-- <a href="/direktur/purchase-order/{{ $po->id }}/decline"
                                                class="btn btn-danger">
                                                <i class="fa-solid fa-x"></i> Decline
                                            </a> --}}
                                                <button class="btn btn-danger" onclick="decline({{ $po->id }})">
                                                    <i class="fa-solid fa x"></i>
                                                    Decline
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($po->acc_direktur == 'belum divalidasi' && $po->status == 'perlu perbaikan')
                                        @if ($komen >= 1)
                                        @else
                                            <div class="card-footer">
                                                <div class="float-sm-right">
                                                    <a href="/direktur/purchase-order/{{ $po->id }}/acc"
                                                        class="btn btn-success">
                                                        <i class="fa-solid fa-check"></i> Accept
                                                    </a>
                                                    {{-- <a href="/direktur/purchase-order/{{ $po->id }}/decline"
                                                class="btn btn-danger">
                                                <i class="fa-solid fa-x"></i> Decline
                                            </a> --}}
                                                    <button class="btn btn-danger" onclick="decline()">
                                                        <i class="fa-solid fa x"></i>
                                                        Decline
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="modal fade" id="ModalKomentar" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-title" class="modal-title">Keterangan</h5>
                <button class="close" type="button" data-dismiss="modal" id="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/purchase-order/decline" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div id="modal-page" class="card-body">
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
                            <input type="hidden" name="id_po" id="id_po" value="{{$po->id}}">
                        </div>
                        <div class="form-group">
                            <div class="float-sm-right">
                                <a href="#" class="btn btn-danger" onclick="cancel()">Cancel</a>
                                <button class="btn btn-success" type="submit">Simpan</button>
                                {{-- <button class="btn btn-success" onclick="confirmDecline()">Simpan</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                {{-- @include('template.modal-komentar') --}}
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

                $(".money").simpleMoneyFormat();
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

            function decline() {
                // console.log(id);
                // $('#id_po').val(id);
                // var po = $('#id_po').val();
            // console.log(po);
            $("#ModalKomentar").modal('show');
            }

        function cancel() {
            $('#keterangan').val('');
            $("#close").click();
            // $('#ModalKomentar').modal('hide');
        }
            // function decline() {
            //     $("#ModalKomentar").modal('show');
            // }
        </script>
    </body>

</html>
