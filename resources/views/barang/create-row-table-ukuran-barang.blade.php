<tr>
    <td class="no-table">{{ $number }}</td>
    <td>
        <div class="input-group">
            <input type="text" class="form-control" name="ukuran[]" value="{{ $ukuran_barang }}">
        </div>
    </td>
    <td>
        <button class="btn btn-danger" onclick="deleteRowUkuran(this)">
            <i class="fa-regular fa-trash-can"></i>
        </button>
    </td>
</tr>
