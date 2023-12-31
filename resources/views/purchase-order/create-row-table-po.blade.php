<tr>
    <td class="no-table">{{ $number }}</td>
    <td>{{ $barang->nama_barang }}</td>
    <td>
        <div class="input-group">
            <input type="hidden" class="id_barang" name="id_barang[]" id="id_barang" value="{{ $barang->id }}">
            <input type="number" class="form-control qty" id="qty" name="qty[]" value="{{ $qty }}"
                onchange="totalHarga(this)" required>
        </div>
    </td>
    <td>
        <div class="input-group">
            <input type="text" class="form-control harga money" id="harga" name="harga[]" value="{{ $harga }}"
                onchange="totalHarga(this)" required>
        </div>
    </td>
    <td class="total money">{{ $jumlah }}</td>
    <td>
        <button class="btn btn-danger" onclick="deleteRow(this)">
            <i class="fa-regular fa-trash-can"></i>
        </button>
    </td>
</tr>
