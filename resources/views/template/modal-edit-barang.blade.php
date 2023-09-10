<div class="modal fade" id="ModalEditBarang" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Barang</h5>
                <button class="close" type="button" data-dismiss="modal" id="close-edit" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- <form action="#" method="post" enctype="multipart/form-data"> --}}
            <form action="{{ route('updatebarang') }}" method="post" enctype="multipart/form-data" id="form-edit-barang">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputNamaBarang">Nama Barang</label>
                            <input type="text" class="form-control" id="input_edit_nama_barang" name="nama_barang"
                                placeholder="Masukkan Nama Barang">
                        </div>
                        <div class="form-group">
                            <label for="inputHargaBarang">Harga Barang</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-rupiah-sign"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control" id="input_edit_harga" name="harga"
                                    placeholder="Masukkan Harga Barang">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputGambarBarang">Input Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="input_edit_image" name="gambar"
                                        onchange="previewImageEdit()">
                                    <label class="custom-file-label" for="input_image">Choose
                                        file</label>
                                </div>
                                <img class="img-preview img-fluid mb-3" id="img-edit-preview">
                            </div>
                        </div>
                        <input type="hidden" name="id_barang" id="id_barang">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary tombol-simpan-edit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
