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
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Detail Request Material</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fuid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="px-2 py-2">
                            <table>
                                <tr>
                                    <td>Tanggal Request</td>
                                    <td>:</td>
                                    <td>16-10-2022</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Kebutuhan</td>
                                    <td>:</td>
                                    <td>20-10-2022</td>
                                </tr>
                                <tr>
                                    <td>Project</td>
                                    <td>:</td>
                                    <td>RS Sanglah</td>
                                </tr>
                            </table>
                            </div>
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <table id="databarang" class="table table-bordered table-hover text-center" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Proyek</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>001</td>
                                                <td>20-10-2022</td>
                                                <td>RS Sanglah</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

        <footer class="main-footer">
            @include('template.footer')
        </footer>
    </div>

    <!-- REQUIRED SCRIPTS -->
    @include('template.script')
    

</body>

</html>
