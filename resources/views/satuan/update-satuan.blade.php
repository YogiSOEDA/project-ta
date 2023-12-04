<div class="form-group">
    <label for="inputNamaSatuan">Nama Satuan</label>
    <input type="text" class="form-control" id="input_nama_satuan" name="nama_satuan" placeholder="Masukkan Nama Satuan"
        value="{{ $data->satuan }}">
</div>
<div class="form-group">
    <div class="float-sm-right">
        <button class="btn btn-success" onclick="update({{ $data->id }})">Simpan</button>
    </div>
</div>
