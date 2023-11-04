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
                                <div class="card-header">
                                    <div class="float-sm-right">
                                        <a href="{{ route('createRM') }}" class="btn btn-success">
                                            <i class="fa-solid fa-plus"></i>
                                            Tambah Data
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="request-material" class="table table-bordered hover text-center" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Request Material</th>
                                                <th>Proyek</th>
                                                <th>Tanggal Request</th>
                                                <th>Tanggal Kebutuhan</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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
            $('ul').Treeview(options)
        });
    </script>
</body>

</html>
