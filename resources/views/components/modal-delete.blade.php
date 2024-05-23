<div class="modal modal-blur fade" id="modal-delete" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Delete {{$title}}</div>
                <div>Apakah anda yakin ingin menghapus data ini?</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Kembali
                </button>
                <form method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Ya, Hapus data</button>
                </form>
            </div>
        </div>
    </div>
</div>
