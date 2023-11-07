<tr>
    <td class="no-table">{{ $number }}</td>
    <td>{{ $barang->nama_barang }}</td>
    <td>
        <div class="input-group">
            <input type="hidden" class="id_barang" name="id_barang[]" id="id_barang" value="{{ $barang->id }}">
            <input type="hidden" name="id_detail_rm[]" id="id_detail_rm[]" value="0">
            <input type="number" class="form-control qty" id="qty" name="qty[]" value="{{ $qty }}">
        </div>
    </td>
    <td>
        <button class="btn btn-danger" onclick="deleteRow(this)">
            <i class="fa-regular fa-trash-can"></i>
        </button>
    </td>
</tr>
