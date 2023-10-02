<option selected disabled>Pilih Proyek</option>
@foreach ($data as $item)
    <option value="{{ $item->id }}">{{ $item->nama_proyek }}</option>
@endforeach
