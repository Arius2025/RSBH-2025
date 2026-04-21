@forelse($docs as $doc)
    <div class="d-flex align-items-center p-3 mb-3 border rounded-3 hover-shadow transition">
        <div class="bg-light p-3 rounded-3 me-4 text-danger">
            <i class="bi bi-file-earmark-pdf-fill fs-3"></i>
        </div>
        <div class="flex-grow-1">
            <h5 class="mb-1 fw-bold text-dark">{{ $doc->title }}</h5>
            <div class="d-flex small text-muted">
                <span class="me-3"><i class="bi bi-calendar-event me-1"></i> {{ $doc->created_at->format('d M Y') }}</span>
                <span><i class="bi bi-hdd me-1"></i> {{ $doc->file_size }}</span>
            </div>
        </div>
        <div class="ms-3">
            <a href="{{ asset('storage/' . $doc->file_path) }}" class="btn btn-success rounded-pill px-4" target="_blank">
                <i class="bi bi-download me-2"></i> Download
            </a>
        </div>
    </div>
@empty
    <div class="text-center py-5">
        <div class="text-muted mb-3">
            <i class="bi bi-folder2-open display-4 opacity-25"></i>
        </div>
        <h5 class="text-secondary">Belum ada dokumen dalam kategori ini</h5>
        <p class="small text-muted">Silakan periksa kembali nanti untuk pembaruan Dokumen.</p>
    </div>
@endforelse

<style>
.hover-shadow:hover {
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.05)!important;
    border-color: #198754!important;
    transform: translateY(-2px);
}
.transition {
    transition: all 0.3s ease;
}
</style>
