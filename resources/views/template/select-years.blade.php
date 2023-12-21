<option selected disabled value="">Pilih Tahun</option>
@foreach ($data as $item)
    <option value="{{ $item->year }}">{{ $item->year }}</option>
@endforeach
