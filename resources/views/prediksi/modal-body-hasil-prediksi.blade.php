<div class="form-group">
    <p>Hasil prediksi persediaan {{ $barang->nama_barang }} yang akan digunakan untuk bulan {{ $bulan }} tahun {{ $tahun }} adalah sebesar {{ $wma }} {{ $barang->satuan->satuan }}.</p>
</div>
<div class="form-group">
    <div class="float-sm-right">
        <a href="/prediksi/detail/{{ $prediksi_hasil }}" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>
    </div>
</div>
