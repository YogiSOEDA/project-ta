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
                                                <td>{{ $rm->id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Task</td>
                                                <td>:</td>
                                                <td style="text-transform:capitalize">{{ $rm->jenis_request }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Request</td>
                                                <td>:</td>
                                                <td>{{ $rm->tanggal_request }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Kebutuhan</td>
                                                <td>:</td>
                                                <td>{{ $rm->tanggal_kebutuhan }}</td>
                                            </tr>
                                            <tr>
                                                <td>Proyek</td>
                                                <td>:</td>
                                                <td>{{ $rm->proyek->nama_proyek }}</td>
                                            </tr>

                                        </table>
                                    </div>

                                    <table id="detail-rm" class="table table-bordered table-hover text-center mt-md-4">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detail as $item)
                                                <tr>
                                                    <td class="no-table"></td>
                                                    <td>{{ $item->barang->nama_barang }}</td>
                                                    <td>{{ $item->jumlah }} {{ $item->barang->satuan->satuan }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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

    <script>
        $(document).ready(function() {
            numberingTable();
        })

        function numberingTable() {
            var number = 0;
            $('#detail-rm tbody tr').each(function(index, no) {
                $(no).find('.no-table').text(++number);
            });
        }
    </script>
</body>

</html>
