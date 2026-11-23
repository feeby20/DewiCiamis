@extends('layouts.admin')

@section('title', 'Kelola Berita - Admin')
@section('page_title', 'Manajemen Berita & Publikasi')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h5 class="fw-bold mb-1 text-dark">Daftar Berita Wisata</h5>
            <p class="text-muted small mb-0">Kelola informasi, pengumuman, dan artikel wisata desa Ciamis.</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-success rounded-pill px-4 fw-bold">
            <i class="bi bi-plus-lg me-1"></i> Tulis Berita Baru
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th style="width: 80px;">Gambar</th>
                    <th>Judul Berita</th>
                    <th>Tanggal</th>
                    <th>Ringkasan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beritaList as $item)
                    <tr>
                        <td>
                            @if($item->gambar)
                                <img src="{{ asset($item->gambar) }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;" alt="">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 60px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong class="text-dark d-block">{{ $item->judul }}</strong>
                        </td>
                        <td>
                            <small class="text-muted">{{ $item->tanggal ? $item->tanggal->format('d/m/Y') : '-' }}</small>
                        </td>
                        <td>
                            <span class="small text-secondary">{{ Str::limit($item->ringkasan, 80) }}</span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-newspaper display-4 text-muted d-block mb-2"></i>
                            Belum ada artikel berita yang dipublikasikan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $beritaList->links() }}
    </div>
</div>
@endsection
