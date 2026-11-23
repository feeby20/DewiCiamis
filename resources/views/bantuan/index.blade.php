@extends('layouts.app')

@section('title', 'Pusat Bantuan & FAQ - DewiCiamis')

@section('content')
<div class="container page-container" style="padding-top: 105px !important; padding-bottom: 40px !important;">
    <!-- Header -->
    <div class="text-center mb-4">
        <span class="badge bg-success-subtle text-success px-3 py-1-5 rounded-pill mb-2 small fw-semibold">
            <i class="bi bi-headset me-1"></i> LAYANAN BANTUAN
        </span>
        <h1 class="fw-bold text-dark mb-2" style="font-size: 1.85rem;">Pusat Bantuan & Tanya Jawab</h1>
        <p class="text-muted mx-auto mb-0" style="max-width: 580px; font-size: 0.95rem;">
            Punya pertanyaan mengenai reservasi tiket, pembayaran, atau informasi destinasi? Temukan jawabannya di sini atau hubungi kami.
        </p>
    </div>

    @if(session('success_bantuan'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success_bantuan') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Cek Status Tiket Bantuan -->
    <div class="card border-0 shadow-sm rounded-4 p-3 p-md-3 mb-4 bg-white">
        <h6 class="fw-bold mb-2 text-dark"><i class="bi bi-search me-2 text-success"></i>Lacak Tiket Bantuan Anda</h6>
        <form action="{{ route('support.index') }}" method="GET" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="ticket_code" class="form-control rounded-pill" style="font-size: 0.9rem;" placeholder="Masukkan kode tiket bantuan (Contoh: BANTUAN-20261028-968484DA)" value="{{ request('ticket_code') }}" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100 rounded-pill fw-semibold" style="font-size: 0.9rem;">
                    Cek Jawaban Admin
                </button>
            </div>
        </form>

        @if($trackedMessage)
            <div class="mt-3 p-3 border rounded-3 bg-light">
                <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                    <h6 class="fw-bold text-dark mb-0">{{ $trackedMessage->subject }}</h6>
                    <span class="badge bg-{{ $trackedMessage->status === 'selesai' ? 'success' : 'warning' }} px-3 py-1-5 rounded-pill small">
                        Status: {{ ucwords(str_replace('_', ' ', $trackedMessage->status)) }}
                    </span>
                </div>
                <small class="text-muted d-block mb-2" style="font-size: 0.8rem;">Topik: {{ $trackedMessage->topic }} &bull; Tanggal: {{ $trackedMessage->created_at ? $trackedMessage->created_at->format('d M Y H:i') : '-' }}</small>
                <div class="bg-white p-3 rounded-3 mb-3 border small">
                    <strong class="text-secondary d-block mb-1">Pesan Anda:</strong>
                    {{ $trackedMessage->message }}
                </div>

                @if($trackedMessage->admin_reply)
                    <div class="bg-success-subtle p-3 rounded-3 border border-success small">
                        <strong class="text-success d-block mb-1"><i class="bi bi-reply-fill me-1"></i>Tanggapan Petugas Dispar Ciamis:</strong>
                        <p class="mb-1 text-dark">{{ $trackedMessage->admin_reply }}</p>
                        <small class="text-muted">{{ $trackedMessage->replied_at ? $trackedMessage->replied_at->format('d M Y H:i') : '' }}</small>
                    </div>
                @else
                    <div class="text-muted small fst-italic">
                        <i class="bi bi-clock me-1"></i>Petugas kami sedang meninjau pertanyaan Anda. Silakan periksa kembali berkala.
                    </div>
                @endif
            </div>
        @endif
    </div>

    <div class="row g-4">
        <!-- Kolom FAQ -->
        <div class="col-lg-6">
            <h5 class="fw-bold text-dark mb-3" style="font-size: 1.2rem;">
                <i class="bi bi-question-circle-fill text-success me-2"></i>Pertanyaan Sering Diajukan
            </h5>

            <div class="accordion accordion-flush" id="faqAccordion">
                @php $faqIdx = 0; @endphp
                @foreach($faqs as $cat => $items)
                    <h6 class="fw-bold text-success text-uppercase mt-3 mb-2" style="font-size: 0.775rem; letter-spacing: 0.5px;">{{ $cat }}</h6>
                    @foreach($items as $faq)
                        @php $faqIdx++; @endphp
                        <div class="accordion-item border-0 mb-2 shadow-sm rounded-3 overflow-hidden">
                            <h2 class="accordion-header" id="heading{{ $faqIdx }}">
                                <button class="accordion-button collapsed fw-semibold text-dark py-2 px-3" style="font-size: 0.925rem;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faqIdx }}" aria-expanded="false" aria-controls="collapse{{ $faqIdx }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faqIdx }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faqIdx }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary py-3 px-3 small" style="line-height: 1.65; font-size: 0.875rem;">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        <!-- Kolom Form Kirim Pertanyaan -->
        <div class="col-lg-6" id="form-bantuan">
            <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 bg-white">
                <h5 class="fw-bold text-dark mb-1" style="font-size: 1.2rem;">Kirim Pertanyaan</h5>
                <p class="text-muted small mb-3">Tim kami akan membalas pertanyaan atau keluhan Anda sesegera mungkin.</p>

                @if ($errors->any())
                    <div class="alert alert-danger py-2 small">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('support.store') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label small fw-semibold mb-1">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control form-control-sm py-2" value="{{ Auth::check() ? Auth::user()->nama : old('name') }}" placeholder="Masukkan nama Anda" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold mb-1">Alamat Email</label>
                        <input type="email" name="email" class="form-control form-control-sm py-2" value="{{ Auth::check() ? Auth::user()->email : old('email') }}" placeholder="nama@email.com" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold mb-1">Topik Bantuan</label>
                        <select name="topic" class="form-select form-select-sm py-2" required>
                            <option value="">-- Pilih Topik --</option>
                            <option value="Pemesanan Tiket">Pemesanan Tiket</option>
                            <option value="Pembayaran">Pembayaran</option>
                            <option value="Akun">Akun & Login</option>
                            <option value="Informasi Destinasi">Informasi Destinasi</option>
                            <option value="Keluhan Lainnya">Keluhan Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold mb-1">Subjek</label>
                        <input type="text" name="subject" class="form-control form-control-sm py-2" value="{{ old('subject') }}" placeholder="Ringkasan kendala Anda" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold mb-1">Isi Pertanyaan / Pesan</label>
                        <textarea name="message" class="form-control form-control-sm" rows="3" placeholder="Jelaskan secara rinci kendala atau pertanyaan Anda..." required minlength="10">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold py-2" style="font-size: 0.925rem;">
                        <i class="bi bi-send me-1"></i> Kirim Pesan Bantuan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
