<div class="modal fade" id="ModalTambahBarang">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Barang</h5>
                <button class="close" type="button" data-dismiss="modal" id="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('storedatabarang') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputNamaBarang">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang"
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
                                <input type="number" class="form-control" id="harga" name="harga"
                                    placeholder="Masukkan Harga Barang">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputGambarBarang">Input Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                        name="gambar">
                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                        file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>