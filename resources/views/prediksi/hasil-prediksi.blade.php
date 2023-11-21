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
                            <h1 class="m-0">Hasil Prediksi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Prediksi</li>
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
                                    <h5 class="m-0">HASIL PREDIKSI PENGELUARAN BULAN {{ $bulan }} TAHUN {{ $tahun }}</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <td width="30%">Hasil Weighted Moving Average (WMA)</td>
                                            <td></td>
                                            <td>
                                                = (({{ $satu_bulan_lalu }} x 3)+({{ $dua_bulan_lalu }} x 2)+({{ $tiga_bulan_lalu }} x 1))/6<br>
                                                = {{ $wma }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ERROR</td>
                                            <td></td>
                                            <td>
                                                = {{ $nilai_aktual }} - {{ $wma }}<br>
                                                = {{ $error }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mean Absolute Deviation (MAD)</td>
                                            <td></td>
                                            <td>
                                                = ABS({{ $error }})<br>
                                                = {{ $mad }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mean Squared Error (MSE)</td>
                                            <td></td>
                                            <td>
                                                = {{ $mad }}^2<br>
                                                = {{ $mse }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mean Absolute Percentage Error (MAPE)</td>
                                            <td></td>
                                            <td>
                                                = {{ $error }} / {{ $nilai_aktual }} x 100<br>
                                                = {{ $mape }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PREDIKSI PENGELUARAN BULAN {{ $bulan }} TAHUN {{ $tahun }}</td>
                                            <td></td>
                                            <td>
                                                = {{ $wma }}
                                            </td>
                                        </tr>
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
</body>

</html>
