<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    @include('template.head')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('template.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('template.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Dashboard</li>
                                {{-- <li class="breadcrumb-item "><a href="#">Home</a></li> --}}
                                {{-- <li class="breadcrumb-item active">Starter Page</li> --}}
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @if (auth()->user()->role == 'admin')
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $po }}</h3>
                                        <p>Purchase Order</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <a href="/purchase-order" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{ $rm }}</h3>
                                        <p>Request Material</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-clipboard"></i>
                                    </div>
                                    <a href="/request-material" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if (auth()->user()->role == 'teknisi')
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{ $rm }}</h3>
                                        <p>Request Material</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-clipboard"></i>
                                    </div>
                                    <a href="/teknisi/request-material" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if (auth()->user()->role == 'direktur')
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $po }}</h3>
                                        <p>Purchase Order</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <a href="/direktur/purchase-order" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if (auth()->user()->role == 'akunting')
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $po }}</h3>
                                        <p>Purchase Order</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <a href="/akunting/purchase-order" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if (auth()->user()->role == 'logistik')
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{ $rm }}</h3>
                                        <p>Request Material</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-clipboard"></i>
                                    </div>
                                    <a href="/logistik/request-material" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $po }}</h3>
                                        <p>Purchase Order</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <a href="/logistik/purchase-order" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main content -->
            {{-- <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>

                                    <p class="card-text">
                                        Some quick example text to build on the card title and make up the bulk of the
                                        card's
                                        content.
                                    </p>

                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>

                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>

                                    <p class="card-text">
                                        Some quick example text to build on the card title and make up the bulk of the
                                        card's
                                        content.
                                    </p>
                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div> --}}
            {{-- </div><!-- /.card --> --}}
            {{-- </div> --}}
            <!-- /.col-md-6 -->
            {{-- <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="m-0">Featured</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Special title treatment</h6>

                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>

                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="m-0">Featured</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Special title treatment</h6>

                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div> --}}
            <!-- /.col-md-6 -->
            {{-- </div> --}}
            <!-- /.row -->
            {{-- </div><!-- /.container-fluid --> --}}
            {{-- </div> --}}
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            @include('template.footer')
        </footer>
    </div>

    {{-- @include('sweetalert::alert') --}}
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('template.script')

</body>

</html>
