<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Tamu - Velora</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.1.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="bg-light">

    <main class="container mt-4 mb-5">
        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary rounded-pill mb-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
        </a>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold m-0">Daftar Tamu</h4>
                    <p class="text-muted m-0 small">Undangan: <b>{{ $invitation->title }}</b></p>
                </div>
                <!-- Form Tambah Tamu Cepat -->
                <form action="{{ route('guests.store', $invitation->id) }}" method="POST" class="d-flex gap-2">
                    @csrf
                    <input type="text" name="name" class="form-control form-control-sm rounded-3" placeholder="Nama Tamu Baru..." required>
                    <button type="submit" class="btn btn-primary btn-sm rounded-3 text-nowrap">Tambah</button>
                </form>
            </div>
            
            <div class="card-body p-0">
                @if(session('success'))
                    <div class="alert alert-success m-3 rounded-3">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Nama Tamu</th>
                                <th>Status RSVP</th>
                                <th>Link Undangan</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($guests as $g)
                                <tr>
                                    <td class="ps-4 fw-bold">{{ $g->name }}</td>
                                    <td>
                                        @if($g->rsvp_status === 'hadir')
                                            <span class="badge bg-success">Hadir</span>
                                        @elseif($g->rsvp_status === 'tidak_hadir')
                                            <span class="badge bg-danger">Tidak Hadir</span>
                                        @else
                                            <span class="badge bg-secondary">Belum Konfirmasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Tombol Copy Link -->
                                        <button class="btn btn-sm btn-outline-primary rounded-3" onclick="copyLink('{{ route('invitations.show', ['invitation' => $invitation->id, 'to' => $g->unique_code]) }}', this)">
                                            <i class="fa-solid fa-copy me-1"></i> Copy Link
                                        </button>
                                    </td>
                                    <td class="text-end pe-4">
                                        <form action="{{ route('guests.destroy', [$invitation->id, $g->id]) }}" method="POST" onsubmit="return confirm('Yakin mau hapus tamu ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">Belum ada tamu yang ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        function copyLink(text, btn) {
            navigator.clipboard.writeText(text).then(() => {
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Tersalin!';
                btn.classList.replace('btn-outline-primary', 'btn-success');
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.replace('btn-success', 'btn-outline-primary');
                }, 2000);
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>