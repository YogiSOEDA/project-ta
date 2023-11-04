<tr>
    <td class="no-table">{{ $number }}</td>
    <td>
        <div class="input-group">
            <input type="text" class="form-control" name="jenis[]" value="{{ $jenis_barang }}">
        </div>
    </td>
    <td>
        <button class="btn btn-danger" onclick="deleteRowType(this)">
            <i class="fa-regular fa-trash-can"></i>
        </button>
    </td>
</tr>
