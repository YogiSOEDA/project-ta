<option selected disabled>Pilih Satuan</option>
@foreach ($data as $item)
    <option value="{{ $item->id }}">{{ $item->satuan }}</option>
@endforeach
