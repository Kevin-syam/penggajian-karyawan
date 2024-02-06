<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-semibold" id="deleteModalLabel">Konfirmasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Menghapus data ini ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak,
                    Batalkan!</button>
                <a class="btn btn-danger" href="{{ $url }}"
                    onclick="event.preventDefault(); document.getElementById('delete-item').submit();">
                    Yes, Hapus!
                </a>

                <form id="delete-item" action="{{ $url }}" method="POST" class="d-none">
                    @csrf @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>
