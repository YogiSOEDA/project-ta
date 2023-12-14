<div class="form-group">
    <label for="name">Nama User</label>
    <div class="input-group">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        <input type="text" class="form-control" id="name" name="name" placeholder="Full name" value="{{ $data->name }}" required>
    </div>
</div>
<div class="form-group">
    <label for="username">Username</label>
    <div class="input-group">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        <input type="username" class="form-control" id="username" name="username" placeholder="Username" value="{{ $data->username }}" required>
    </div>
</div>
<div class="form-group">
    <label for="role">Role</label>
    <select class="form-control" id="role" name="role" required>
        {{-- <option selected disabled value="">--Role--</option> --}}
        <option {{ $data->role == 'admin' ? 'selected' : '' }} value="admin">Admin</option>
        <option {{ $data->role == 'akunting' ? 'selected' : '' }} value="akunting">Akunting</option>
        <option {{ $data->role == 'direktur' ? 'selected' : '' }} value="direktur">Direktur</option>
        <option {{ $data->role == 'teknisi' ? 'selected' : '' }} value="teknisi">Teknisi</option>
        <option {{ $data->role == 'logistik' ? 'selected' : '' }} value="logistik">Logistik</option>
    </select>
</div>
<div class="form-group">
    <div class="float-sm-right">
        <button class="btn btn-success" onclick="update({{ $data->id }})">Simpan</button>
    </div>
</div>
