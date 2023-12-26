<form action="/data-barang/update" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="inputNamaBarang">Nama Barang</label>
        <input type="text" class="form-control" id="input_nama_barang" name="nama_barang"
            placeholder="Masukkan Nama Barang" value="{{ $data->nama_barang }}">
    </div>
    <div class="form-group" id="select-satuan">
        <label>Nama Satuan</label>
        <select class="form-control select2" id="satuan_id_select" name="satuan_id" style="width: 100%">
        </select>
        <input type="hidden" id="satuan" value="{{$data->satuan_id}}">
    </div>
    <div class="form-group">
        <label for="inputHargaBarang">Harga Barang</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-solid fa-rupiah-sign"></i>
                </span>
            </div>
            <input type="text" class="form-control money" id="input_harga" name="harga"
                placeholder="Masukkan Harga Barang" value="{{ $data->harga }}">
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
    <input type="hidden" name="id_barang" value="{{ $data->id }}">
    <div class="form-group">
        <div class="float-sm-right">
            <button class="btn btn-success" type="submit">Simpan</button>
            {{-- <button class="btn btn-success" type="submit" onclick="store()">Simpan</button> --}}
        </div>
    </div>
</form>
