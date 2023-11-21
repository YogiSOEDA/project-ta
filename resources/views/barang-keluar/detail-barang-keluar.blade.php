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
                            <h1 class="m-0">Barang Keluar</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Barang Keluar</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fuid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <div class="col-lg-6">
                                        <table class="text-left" width="50%">
                                            <tr>
                                                <td>Barang Keluar No.</td>
                                                <td>:</td>
                                                <td id="id_bk">{{ $bk->id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td>:</td>
                                                <td>{{ $bk->tanggal }}</td>
                                            </tr>
                                            <tr>
                                                <td>Poyek</td>
                                                <td>:</td>
                                                <td>{{ $bk->proyek->nama_proyek }}</td>
                                            </tr>
                                            <tr>
                                                <td>Diproses Oleh</td>
                                                <td>:</td>
                                                <td>{{ $bk->user->name }} ({{$bk->user->role}})</td>
                                            </tr>
                                        </table>

                                        <table id="detail-bk" class="table table-bordered table-hover text-center mt-md-4">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detail as $dtl)
                                                <tr>
                                                    <td class="no-table"></td>
                                                    <td>{{ $dtl->barang->nama_barang }}</td>
                                                    <td>{{ $dtl->jumlah }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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

    <script>
        $(document).ready(function() {
            numberingTable();
        });

        function numberingTable() {
            var number = 0;
            $('#detail-bk tbody tr').each(function(index, no) {
                $(no).find('.no-table').text(++number);
            });
        }
    </script>
</body>
</html>
