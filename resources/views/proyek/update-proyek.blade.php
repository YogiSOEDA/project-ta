<div class="form-group">
    <label for="inputNamaProyek">Nama Proyek</label>
    <input type="text" class="form-control" id="input_nama_proyek" name="nama_proyek" placeholder="Masukkan Nama Proyek"
        value="{{ $data->nama_proyek }}">
</div>
<div class="form-group">
    <label for="inputCpProyek">CP Proyek</label>
    <div class="input-group">
        <input type="text" class="form-control" id="input_cp_proyek" name="cp_proyek"
            placeholder="Masukkan CP Proyek" value="{{ $data->cp_proyek }}">
    </div>
</div>
<div class="form-group">
    <div class="float-sm-right">
        <button class="btn btn-success" onclick="update({{ $data->id }})">Simpan</button>
    </div>
</div>
