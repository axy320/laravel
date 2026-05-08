@extends('layouts.app')
@section('title', 'Detail Peminjaman')
@section('breadcrumb', 'Informasi lengkap transaksi peminjaman')

@section('content')
<div class="row g-4 fade-in">
    <!-- Main Info -->
    <div class="col-lg-8">
        <div class="modern-card h-100">
            <div class="card-header-custom">
                <h5><i class="fas fa-list-alt me-2" style="color:var(--primary)"></i>Rincian Transaksi</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('peminjamans.index') }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-arrow-left"></i> Kembali</a>
                    @if($peminjaman->status === 'dipinjam')
                    <form action="{{ route('peminjamans.kembalikan', $peminjaman) }}" method="POST">
                        @csrf @method('PUT')
                        <button type="submit" class="btn-modern btn-return btn-sm-modern"><i class="fas fa-undo"></i> Kembalikan Buku</button>
                    </form>
                    @endif
                </div>
            </div>
            <div class="card-body-custom">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-modern">Status Peminjaman</label>
                        <div class="p-3 rounded-3 d-flex align-items-center gap-2" style="background: var(--body-bg);">
                            @if($peminjaman->status === 'dipinjam')
                                <span class="badge-modern badge-warning fs-6"><i class="fas fa-clock"></i> Sedang Dipinjam</span>
                            @elseif($peminjaman->status === 'terlambat')
                                <span class="badge-modern badge-danger fs-6"><i class="fas fa-exclamation-triangle"></i> Terlambat Pengembalian</span>
                            @else
                                <span class="badge-modern badge-success fs-6"><i class="fas fa-check-circle"></i> Sudah Dikembalikan</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-modern">Tanggal Pinjam</label>
                        <div class="p-3 rounded-3" style="background: var(--body-bg); font-weight: 500;">
                            {{ $peminjaman->tanggal_pinjam->format('d F Y') }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-modern">Batas Pengembalian (Deadline)</label>
                        <div class="p-3 rounded-3" style="background: var(--body-bg); font-weight: 500; color: var(--danger);">
                            {{ $peminjaman->tanggal_kembali->format('d F Y') }}
                        </div>
                    </div>

                    @if($peminjaman->tanggal_dikembalikan)
                    <div class="col-md-12">
                        <label class="form-label-modern">Tanggal Dikembalikan</label>
                        <div class="p-3 rounded-3" style="background: rgba(16, 185, 129, 0.05); color: #065f46; font-weight: 600;">
                            {{ $peminjaman->tanggal_dikembalikan->format('d F Y') }}
                        </div>
                    </div>
                    @endif

                    <div class="col-md-12">
                        <div class="stat-card pink mb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="stat-label">Total Denda (Keterlambatan {{ $peminjaman->hariTerlambat() }} hari)</div>
                                    <div class="stat-value">Rp {{ number_format($peminjaman->hitungDenda(), 0, ',', '.') }}</div>
                                </div>
                                <div class="stat-icon"><i class="fas fa-money-bill-wave"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Info -->
    <div class="col-lg-4">
        <div class="row g-4">
            <!-- Peminjam Info -->
            <div class="col-12">
                <div class="modern-card">
                    <div class="card-header-custom">
                        <h5><i class="fas fa-user-graduate me-2" style="color:var(--secondary)"></i>Data Peminjam</h5>
                    </div>
                    <div class="card-body-custom">
                        <h6 style="font-weight: 700; margin-bottom: 4px;">{{ $peminjaman->peminjam_nama }}</h6>
                        
                        @if($peminjaman->siswa_id)
                            <p class="text-muted small mb-3">NIS: {{ $peminjaman->siswa->nis ?? '-' }}</p>
                            <div class="d-flex flex-column gap-2 mt-3">
                                <div class="small"><i class="fas fa-school me-2 text-muted"></i> Kelas: {{ $peminjaman->siswa->kelas ?? '-' }}</div>
                                <div class="small"><i class="fas fa-phone me-2 text-muted"></i> WA: {{ $peminjaman->siswa->no_hp ?? '-' }}</div>
                            </div>
                        @elseif($peminjaman->pengunjung_id)
                            <p class="text-muted small mb-3">Pengunjung Umum</p>
                            <div class="d-flex flex-column gap-2 mt-3">
                                <div class="small"><i class="fas fa-home me-2 text-muted"></i> Alamat: {{ $peminjaman->pengunjung->alamat ?? '-' }}</div>
                                <div class="small"><i class="fas fa-phone me-2 text-muted"></i> WA: {{ $peminjaman->pengunjung->no_hp ?? '-' }}</div>
                            </div>
                        @else
                            <p class="text-muted small mb-3">Data Peminjam Tidak Ditemukan</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Buku Info -->
            <div class="col-12">
                <div class="modern-card">
                    <div class="card-header-custom">
                        <h5><i class="fas fa-book me-2" style="color:var(--success)"></i>Data Buku</h5>
                    </div>
                    <div class="card-body-custom">
                        <h6 style="font-weight: 700; margin-bottom: 4px;">{{ $peminjaman->buku->judul_buku ?? 'N/A' }}</h6>
                        <p class="text-muted small mb-3">Kode: {{ $peminjaman->buku->kode_buku ?? '-' }}</p>
                        <div class="d-flex flex-column gap-2 mt-3">
                            <div class="small"><i class="fas fa-user-edit me-2 text-muted"></i> Penulis: {{ $peminjaman->buku->penulis ?? '-' }}</div>
                            <div class="small"><i class="fas fa-th me-2 text-muted"></i> Kategori: {{ $peminjaman->buku->kategori ?? '-' }}</div>
                            <div class="small"><i class="fas fa-layer-group me-2 text-muted"></i> Dipinjam: {{ $peminjaman->jumlah_pinjam }} pc</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection