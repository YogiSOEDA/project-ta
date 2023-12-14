<form action="/data-user/store" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Nama User</label>
        <div class="input-group">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            <input type="text" class="form-control" id="name" name="name" placeholder="Full name" required>
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
            <input type="username" class="form-control" id="username" name="username" placeholder="Username" required>
        </div>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select class="form-control" id="role" name="role" required>
            <option selected disabled value="">--Role--</option>
            <option value="admin">Admin</option>
            <option value="akunting">Akunting</option>
            <option value="direktur">Direktur</option>
            <option value="teknisi">Teknisi</option>
            <option value="logistik">Logistik</option>
        </select>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <div class="input-group">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
    </div>
    <div class="form-group">
        <div class="float-sm-right">
            <button class="btn btn-success" type="submit">Simpan</button>
        </div>
    </div>
    {{-- <div class="form-group">
    <div class="float-sm-right">
        <button class="btn btn-success" onclick="store()">Simpan</button>
    </div>
</div> --}}
</form>
