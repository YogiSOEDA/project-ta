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
                                <h1 class="m-0">Data User</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Data User</li>
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
                                                Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="data-user" class="table table-bordered table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Username</th>
                                                    <th>Role</th>
                                                    <th>Status User</th>
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
                @include('user.modal-tambah-user')
            </div>

            <footer class="main-footer">
                @include('template.footer')
            </footer>

            @include('sweetalert::alert')
        </div>

        @include('template.script')

        <script>
            $(document).ready(function() {
                table();
            });

            function table() {
                $('#data-user').DataTable({
                    ordering: true,
                    serverSide: true,
                    processing: true,
                    ajax: {
                        'url': "{{ url('data-user/tabel') }}"
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            width: '10px',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'username',
                            name: 'username'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'status',
                            name: 'status'
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
                $.get("{{ url('data-user/create') }}", {}, function(data, status) {
                    $("#modal-page").html(data);
                    $("#ModalUser").modal('show');
                });
            }

            function show(id) {
                $.get("{{ url('data-user') }}/" + id, {}, function(data, status) {
                    $("#modal-page").html(data);
                    $("#modal-title").html('Update User');
                    $("#ModalUser").modal('show');
                });
            }

            function status(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Anda Yakin?",
                    text: "Anda akan mengubah status user ini",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: "{{ url('data-user/update-status') }}/" + id,
                            success: function(data) {
                                swalWithBootstrapButtons.fire({
                                    title: "Berhasil!",
                                    text: "Data berhasil diubah",
                                    icon: "success"
                                });
                                $('#data-user').DataTable().ajax.reload();
                            }
                        })
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                            title: "Gagal",
                            text: "Data gagal diubah",
                            icon: "error"
                        });
                    }
                });
            }

            function update(id) {
                var name = $("#name").val();
                var username = $("#username").val();
                var role = $("#role").val();

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Anda Yakin?",
                    text: "Anda akan mengubah data user ini",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: "{{ url('data-user/update') }}/" + id,
                            data: "name=" + name + "&username=" + username + "&role=" + role,
                            success: function(data) {
                                swalWithBootstrapButtons.fire({
                                    title: "Berhasil!",
                                    text: "Data berhasil diubah",
                                    icon: "success"
                                });
                                $("#close").click();
                                $('#data-user').DataTable().ajax.reload();
                            }
                        })
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                            title: "Gagal",
                            text: "Data gagal diubah",
                            icon: "error"
                        });
                    }
                });
            }

            function store() {
                var name = $("#name").val();
                var username = $("#username").val();
                var role = $("#role").val();
                var password = $("#password").val();
                // console.log(password);

                $.ajax({
                    type: "get",
                    url: "{{ url('data-user/store') }}",
                    data: "name=" + name + "&username=" + username + "&role=" + role + "&password=" + password,
                    success: function(data) {
                        // Swal.fire({
                        //     title: "Berhasil!",
                        //     text: "Data berhasil diubah",
                        //     icon: "success"
                        // });
                        $("#close").click();
                        $('#data-user').DataTable().ajax.reload();
                    }
                })
            }
        </script>
    </body>

</html>
