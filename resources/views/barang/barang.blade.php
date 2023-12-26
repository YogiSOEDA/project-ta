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
                            <h1 class="m-0">Data Barang</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Data Barang</li>
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
                                        <button class="btn btn-success" onclick="create()">
                                            <i class="fa-solid fa-plus"></i>
                                            Tambah Barang
                                        </button>
                                        {{-- <a href="#" class="btn btn-success" data-toggle="modal"
                                            data-target="#ModalTambahBarang">
                                            <i class="fa-solid fa-plus"></i>
                                            Tambah Barang
                                        </a> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="databarang" class="table table-bordered table-hover" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th class="col-sm-5">Gambar</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @include('barang.modal-tambah-barang')
            {{-- @include('template.modal-tambah-barang')
            @include('template.modal-edit-barang') --}}

        </div>

        <footer class="main-footer">
            @include('template.footer')
        </footer>
    </div>

    @include('sweetalert::alert')

    <input type="hidden" id="table-url-barang" value="{{ route('tabelbarang') }}">
    @include('template.script')

    <script>
        $(document).ready(function() {
            // select2();
            table();
            select2();

            $(".money").simpleMoneyFormat();

            // $('#databarang').DataTable({
            //     ordering: true,
            //     serverSide: true,
            //     processing: true,
            //     ajax: {
            //         'url': $('#table-url-barang').val()
            //     },
            //     columns: [{
            //             data: 'DT_RowIndex',
            //             name: 'DT_RowIndex',
            //             width: '10px',
            //             orderable: false,
            //             searchable: false
            //         },
            //         {
            //             data: 'nama_barang',
            //             name: 'nama_barang'
            //         },
            //         {
            //             data: 'harga',
            //             name: 'harga'
            //         },
            //         {
            //             data: 'gambar',
            //             name: 'gambar',
            //             orderable: false,
            //             searchable: false
            //         },
            //         {
            //             data: 'action',
            //             name: 'action',
            //             orderable: false,
            //             searchable: false
            //         },
            //     ],
            //     responsive: true,
            //     autoWidth: false,
            //     columnDefs: [{
            //         className: 'dt-center',
            //         targets: '_all'
            //     }],
            // });
        });

        function table() {
            $('#databarang').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': $('#table-url-barang').val()
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '10px',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    className: 'dt-center',
                    targets: '_all'
                }],
            });
        }

        function create() {
            // Swal.fire({
            //     icon: 'success',
            //     title: 'Data Berhasil Disimpan'
            // })

            $.get("{{ url('data-barang/create') }}", {}, function(data, status) {
                selectSatuan();
                $("#modal-page").html(data);
                $(".money").simpleMoneyFormat();
                // select2();
                $("#ModalBarang").modal('show');
            });
        }

        function show(id) {
            $.get("{{ url('data-barang/edit') }}/" + id, {}, function(data, status) {
                // select2();
                // console.log(data);
                $("#modal-page").html(data);
                $("#modal-title").html('Update Barang');
                $(".money").simpleMoneyFormat();
                var s = $('#satuan').val();
                selectedSatuan(s);
                console.log(s);
                $("#ModalBarang").modal('show');
            });
            // var nama_barang = $("#input_nama_barang").val();
            // var harga = $("#input_harga").val();
            // var gambar = $("#input_image").val();

            // console.log(gambar);
        }

        $(function() {
            bsCustomFileInput.init();
        });

        function previewImage() {
            const image = document.querySelector('#input_image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.classList.add("col-sm-5");
            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewImageEdit() {
            const image = document.querySelector('#input_edit_image');
            const imgPreview = document.querySelector('#img-edit-preview');

            imgPreview.classList.add("col-sm-5");
            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '.tombol-edit', function(e) {
            var id = $(this).data('id');
            // alert('id isi '+ id);
            $.ajax({
                url: 'editbarang/' + id,
                type: 'GET',
                success: function(response) {
                    $('#ModalEditBarang').modal('show');
                    $('#id_barang').val(id);
                    $('#input_edit_nama_barang').val(response.result.nama_barang);
                    $('#input_edit_harga').val(response.result.harga);
                    // selectedSatuan(response.result.satuan_id);
                    console.log(response);
                    const imgPreview = document.querySelector('#img-edit-preview');

                    imgPreview.classList.add("col-sm-5");
                    imgPreview.style.display = 'block';
                    imgPreview.src = "/storage/" + response.result.gambar;
                    // $('#img-edit-preview').src = response.result.gambar;

                    console.log(response.result);
                    // $('.tombol-simpan-edit').click(function() {
                    //     simpan(id);

                    //     $('#databarang').DataTable().ajax.reload();
                    // });
                }
            });
        });

        function select2() {
            var satuanSelect2 = $('#satuan_id').select2();
            var satuanSelected2 = $('#satuan_id_select').select2();
            satuanSelect2.data('select2').$selection.css('height', '1%');
            satuanSelected2.data('select2').$selection.css('height', '1%');
        }

        function selectSatuan() {
            $.get("{{ url('select-satuan') }}", {}, function(data, status) {
                $("#satuan_id").html(data);
            })
        }
        function selectedSatuan(id) {
            $.get("{{ url('selected-satuan') }}/"+id, {}, function(data, status) {
                $("#satuan_id_select").html(data);
            })
        }



        // window.addEventListener("load", function () {
        //     var ajax = new XMLHttpRequest();
        //     ajax.onreadystatechange = function () {
        //         if (this.status == 500) {
        //             console.log(this.responseText);
        //         }
        //     }
        // })

        // function simpan(id = '') {
        //     if (id == '') {
        //         var var_url = 'storedatabarang';
        //         var var_type = 'POST';
        //     } else {
        //         var var_url = 'updatebarang';//' + id;
        //         var var_type = 'PUT';
        //     }
        //     $.ajax({
        //         url: var_url,
        //         type: 'POST',
        //         data: {
        //             id_barang: $('#id_barang').val(),
        //             nama_barang: $('#input_edit_nama_barang').val(),
        //             harga: $('#input_edit_harga').val(),
        //             gambar: $('#input_edit_image').val()
        //         },
        //         success: function(response) {
        //             $('#databarang').DataTable().ajax.reload();
        //         }
        //     })
        // }
    </script>

    <script src="{{ asset('js/resetmodal.js') }}"></script>
</body>

</html>
