<div class="form-group">
    <label>Date</label>
    <div class="input-group date" id="reservationdate" data-target-input="nearest">
        <input type="date" class="form-control datetimepicker-input" data-target="#reservationdate" id="input_tanggal"
            name="input_tanggal" />
        {{-- <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div> --}}
    </div>
</div>
<div class="form-group">
    <label>Multiple</label>
    <select class="form-control select2" style="width: 100%; height: 30%;">
        <option>Alabama</option>
        <option>Alaska</option>
        <option>California</option>
        <option>Delaware</option>
        <option>Tennessee</option>
        <option>Texas</option>
        <option>Washington</option>
    </select>
</div>
{{-- <div class="form-group">
    <select class="option-proyek" name="data-proyek">
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
    </select>
</div> --}}


<div class="form-group">
    <label for="inputNamaProyek">Nama Proyek</label>
    <input type="text" class="form-control" id="input_nama_proyek" name="nama_proyek"
        placeholder="Masukkan Nama Proyek">
</div>
<div class="form-group">
    <label for="inputCpProyek">CP Proyek</label>
    <div class="input-group">
        <input type="text" class="form-control" id="input_cp_proyek" name="cp_proyek"
            placeholder="Masukkan CP Proyek">
    </div>
</div>
<div class="form-group">
    <div class="float-sm-right">
        <button class="btn btn-success" onclick="store()">Simpan</button>
    </div>
</div>
