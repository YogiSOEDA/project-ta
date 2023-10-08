<form action="/data-barang/store" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="inputNamaBarang">Nama Barang</label>
        <input type="text" class="form-control" id="input_nama_barang" name="nama_barang"
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
            <input type="number" class="form-control" id="input_harga" name="harga"
                placeholder="Masukkan Harga Barang">
        </div>
    </div>
    <div class="form-group">
        <label for="inputGambarBarang">Input Gambar</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="input_image" name="gambar"
                    onchange="previewImage()">
                <label class="custom-file-label" for="input_image">Choose
                    file</label>
            </div>
            <img class="img-preview img-fluid mb-3">
        </div>
    </div>
    <div class="form-group">
        <div class="float-sm-right">
            <button class="btn btn-success" type="submit">Simpan</button>
            {{-- <button class="btn btn-success" type="submit" onclick="store()">Simpan</button> --}}
        </div>
    </div>
</form>
