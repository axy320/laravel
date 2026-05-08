@extends('layouts.app')
@section('title', 'Detail Buku')
@section('breadcrumb', 'Informasi lengkap koleksi buku')

@section('content')
<div class="row g-4 fade-in">
    <div class="col-lg-4">
        <div class="modern-card">
            <div class="card-body-custom text-center py-5">
                <div class="mb-4">
                    <div style="width: 120px; height: 160px; background: var(--body-bg); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 2px dashed var(--border-color);">
                        <i class="fas fa-book" style="font-size: 48px; color: var(--text-muted);"></i>
                    </div>
                </div>
                <h5 style="font-weight: 700; margin-bottom: 8px;">{{ $buku->judul_buku }}</h5>
                <p class="text-muted" style="font-size: 14px; margin-bottom: 16px;">{{ $buku->kode_buku }}</p>
                
                @if($buku->stok_buku > 0)
                    <span class="badge-modern badge-success mb-3"><i class="fas fa-check-circle me-1"></i> Stok Tersedia</span>
                @else
                    <span class="badge-modern badge-danger mb-3"><i class="fas fa-times-circle me-1"></i> Stok Habis</span>
                @endif

                <div class="mt-4 pt-4 border-top">
                    <p class="text-muted small mb-1">Lokasi Rak</p>
                    <h6 style="font-weight: 600;">{{ $buku->rak_buku ?? 'Belum ditentukan' }}</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="modern-card">
            <div class="card-header-custom">
                <h5><i class="fas fa-info-circle me-2" style="color:var(--primary)"></i>Informasi Detail</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('bukus.index') }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <a href="{{ route('bukus.edit', $buku) }}" class="btn-modern btn-edit btn-sm-modern"><i class="fas fa-edit"></i> Edit</a>
                </div>
            </div>
            <div class="card-body-custom">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-modern">Penulis</label>
                        <div class="p-3 rounded-3" style="background: var(--body-bg); font-weight: 500;">{{ $buku->penulis }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-modern">Penerbit</label>
                        <div class="p-3 rounded-3" style="background: var(--body-bg); font-weight: 500;">{{ $buku->penerbit ?? '-' }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-modern">Tahun Terbit</label>
                        <div class="p-3 rounded-3" style="background: var(--body-bg); font-weight: 500;">{{ $buku->tahun_terbit }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-modern">Kategori</label>
                        <div class="p-3 rounded-3" style="background: var(--body-bg); font-weight: 500;">{{ $buku->kategori }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-modern">Stok Buku</label>
                        <div class="p-3 rounded-3" style="background: var(--body-bg); font-weight: 500;">{{ $buku->stok_buku }} pcs</div>
                    </div>
                </div>

                <div class="mt-5">
                    <h6 style="font-weight: 700; margin-bottom: 20px;"><i class="fas fa-history me-2"></i>Riwayat Peminjaman Terakhir</h6>
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Peminjam</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($buku->peminjamans()->with('siswa')->latest()->take(5)->get() as $p)
                                <tr>
                                    <td>{{ $p->siswa->nama_siswa ?? 'N/A' }}</td>
                                    <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                                    <td>{{ $p->tanggal_kembali->format('d/m/Y') }}</td>
                                    <td>
                                        @if($p->status === 'dipinjam')
                                            <span class="badge-modern badge-warning">Dipinjam</span>
                                        @elseif($p->status === 'terlambat')
                                            <span class="badge-modern badge-danger">Terlambat</span>
                                        @else
                                            <span class="badge-modern badge-success">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum pernah dipinjam</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection