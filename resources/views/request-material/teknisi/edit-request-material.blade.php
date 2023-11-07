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
            {{-- <form action="{{ '/teknisi/request-material/'.{{ $rm->id }}.'/update' }}" method="post" enctype="multipart/form-data"> --}}
            <form action="/teknisi/request-material/{{ $rm->id }}/update" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card card-primary card-outline">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        {{-- <div class="col-lg-6"> --}}
                                        <table class="text-left" width="100%">
                                            <tr>
                                                <td width="20%">RM No.</td>
                                                <td width="5%">:</td>
                                                <td width="50%">{{ $rm->id }}</td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Jenis Task</td>
                                                <td>:</td>
                                                <td width="50%" style="text-transform:capitalize">
                                                    {{ $rm->jenis_request }}</td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Tanggal Request</td>
                                                <td>:</td>
                                                <td width="50%">{{ $rm->tanggal_request }}</td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Tanggal Kebutuhan</td>
                                                <td>:</td>
                                                <td width="50%">{{ $rm->tanggal_kebutuhan }}</td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Proyek</td>
                                                <td>:</td>
                                                <td width="50%">{{ $rm->proyek->nama_proyek }}</td>
                                            </tr>
                                        </table>
                                        {{-- </div> --}}
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
                                        <table class="table table-bordered table-hover text-center" id="detail-rm">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Barang</th>
                                                    <th>Qty</th>
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
                                                                <input type="hidden" name="id_detail_rm[]"
                                                                    id="id_detail_rm[]" value="{{ $item->id }}">
                                                                <input type="hidden" class="id_barang"
                                                                    name="id_barang[]" id="id_barang"
                                                                    value="{{ $item->barang_id }}">
                                                                <input type="number" class="form-control qty"
                                                                    name="qty[]" value="{{ $item->jumlah }}">
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                            <button class="btn btn-danger" onclick="deleteItem(this,{{ $item->id }})">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </button>
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-success btn-block" type="submit">
                                            SIMPAN REQUEST MATERIAL
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
        $(document).ready(function() {
            numberingTable();
            select2();
            selectBarang();
        })

        function numberingTable() {
            var number = 0;
            $('#detail-rm tbody tr').each(function(index, no) {
                $(no).find('.no-table').text(++number);
            });
        }

        function select2() {
            var barangSelect2 = $('#barang_id').select2();
            barangSelect2.data('select2').$selection.css('height', '1%');
        }

        function selectBarang() {
            $.get("{{ url('teknisi/request-material/select-barang') }}", {}, function(data, status) {
                $("#barang_id").html(data);
            })
        }

        function qtyBarang() {
            $('#input_qty').val(0);
        }

        function addRow() {
            var barang_id = $("#barang_id").val();
            var qty = $("#input_qty").val();

            var rawCount = $('#detail-rm tbody tr').length;
            rawCount = rawCount + 1;

            $.ajax({
                type: "get",
                url: "{{ url('teknisi/request-material/add-row') }}",
                data: "barang_id=" + barang_id + "&qty=" + qty + "&number=" + rawCount,
                success: function(data) {
                    $("#detail-rm tbody").append(data);

                    selectBarang()
                    $('#input_qty').val('');
                }
            })
        }

        function deleteRow(row) {
            var parent = $(row).closest('#detail-rm tbody tr');
            parent.remove();

            numberingTable();
        }

        function deleteItem(row, id) {
            var parent = $(row).closest('#detail-rm tbody tr');
            // var parentRow = $(row).closest('#detail-rm tbody tr').style();
            // var detail = $('#id_detail_rm[' + row + ']').val();
            // console.log(id);

            parent.hide();

            numberingTable();
            // $.ajax({
            //     type: "get",
            //     url: "/teknisi/request-material/"+id+"/delete-row",//"{{ url('teknisi/request-material') }}/" + id + "delete-row",
            //     success: function(data) {
            //         // console.log(data.result);
            //         parent.remove();

            //         numberingTable();

            //         // console.log(id);
            //     }
            // })
        }
    </script>
</body>

</html>
