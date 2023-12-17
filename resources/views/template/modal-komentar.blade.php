<div class="modal fade" id="ModalKomentar" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-title" class="modal-title">Keterangan</h5>
                <button class="close" type="button" data-dismiss="modal" id="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/purchase-order/decline" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div id="modal-page" class="card-body">
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
                            <input type="hidden" name="id_po" id="id_po">
                        </div>
                        <div class="form-group">
                            <div class="float-sm-right">
                                <a href="#" class="btn btn-danger" onclick="cancel()">Cancel</a>
                                <button class="btn btn-success" type="submit">Simpan</button>
                                {{-- <button class="btn btn-success" onclick="confirmDecline()">Simpan</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
