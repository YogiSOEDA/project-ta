<option selected disabled value="">Pilih Barang</option>
@foreach ($data as $item)
    <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
@endforeach
