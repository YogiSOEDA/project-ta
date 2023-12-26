<option disabled value="">Pilih Satuan</option>
@foreach ($data as $item)
    {{-- <option value="{{ $item->id }}">{{ $item->satuan }}</option> --}}
    <option {{$item->id == $satuan ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->satuan }}</option>
@endforeach
