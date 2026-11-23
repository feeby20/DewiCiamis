@extends('layouts.admin')

@section('title', 'Pusat Bantuan & Pengaduan - Admin')
@section('page_title', 'Kelola Tiket Bantuan & Pengaduan')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1 text-dark">Daftar Pertanyaan & Tiket Masuk</h5>
            <p class="text-muted small mb-0">Pertanyaan dan kendala yang dikirimkan oleh pengunjung melalui formulir bantuan.</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>Kode Tiket</th>
                    <th>Pengirim</th>
                    <th>Topik & Subjek</th>
                    <th>Pesan</th>
                    <th>Status</th>
                    <th>Aksi Balas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                    <tr>
                        <td><strong class="font-monospace text-dark">{{ $msg->ticket_code }}</strong></td>
                        <td>
                            <strong class="text-dark d-block">{{ $msg->name }}</strong>
                            <small class="text-muted">{{ $msg->email }}</small>
                        </td>
                        <td>
                            <span class="badge bg-secondary-subtle text-secondary small mb-1">{{ $msg->topic }}</span>
                            <div class="fw-semibold text-dark">{{ $msg->subject }}</div>
                        </td>
                        <td>
                            <span class="small text-secondary">{{ Str::limit($msg->message, 80) }}</span>
                            @if($msg->admin_reply)
                                <div class="mt-1 small text-success">
                                    <i class="bi bi-reply-fill"></i> Dibalas: {{ Str::limit($msg->admin_reply, 50) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $msg->status === 'selesai' ? 'success' : 'warning' }}-subtle text-{{ $msg->status === 'selesai' ? 'success' : 'warning' }} px-3 py-1 rounded-pill">
                                {{ ucwords(str_replace('_', ' ', $msg->status)) }}
                            </span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#replyModal{{ $msg->id }}">
                                <i class="bi bi-reply-fill me-1"></i> {{ $msg->admin_reply ? 'Ubah Balasan' : 'Balas' }}
                            </button>

                            <!-- Modal Balas -->
                            <div class="modal fade" id="replyModal{{ $msg->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 p-3">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title fw-bold">Balas Tiket #{{ $msg->ticket_code }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.support.reply', $msg->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body py-0">
                                                <div class="p-3 bg-light rounded-3 mb-3 small">
                                                    <strong>Dari:</strong> {{ $msg->name }} ({{ $msg->email }})<br>
                                                    <strong>Topik:</strong> {{ $msg->topic }} - {{ $msg->subject }}<br>
                                                    <strong>Pesan Pengunjung:</strong><br>
                                                    <em>"{{ $msg->message }}"</em>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold small">Tanggapan / Solusi Admin</label>
                                                    <textarea name="admin_reply" class="form-control" rows="4" placeholder="Tuliskan jawaban resmi Anda..." required>{{ $msg->admin_reply }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold">Kirim Jawaban</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada pesan bantuan dari pengunjung.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>
@endsection
