@extends('layouts.app')
@section('title', 'Data Peminjaman')
@section('breadcrumb', 'Kelola transaksi peminjaman buku')

@section('content')
<div class="modern-card fade-in">
    <div class="card-header-custom">
        <h5><i class="fas fa-hand-holding-heart me-2" style="color:var(--primary)"></i>Transaksi Peminjaman</h5>
        <a href="{{ route('peminjamans.create') }}" class="btn-modern btn-add">
            <i class="fas fa-plus"></i> Pinjam Buku
        </a>
    </div>
    <div class="card-body-custom">
        <div class="row g-3 mb-4">
            <div class="col-md-8">
                <form action="{{ route('peminjamans.index') }}" method="GET">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="search" class="form-modern" placeholder="Cari peminjam atau buku..." value="{{ $search ?? '' }}">
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form action="{{ route('peminjamans.index') }}" method="GET" id="filterForm">
                    <select name="filter" class="form-modern" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Semua Status</option>
                        <option value="dipinjam" {{ ($filter ?? '') == 'dipinjam' ? 'selected' : '' }}>Masih Dipinjam</option>
                        <option value="dikembalikan" {{ ($filter ?? '') == 'dikembalikan' ? 'selected' : '' }}>Sudah Kembali</option>
                        <option value="terlambat" {{ ($filter ?? '') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                    <tr>
                        <td style="font-weight:600;">{{ $p->peminjam_nama }}</td>
                        <td>{{ $p->buku->judul_buku ?? 'N/A' }} <small class="text-muted">({{ $p->jumlah_pinjam }} pc)</small></td>
                        <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td>{{ $p->tanggal_kembali->format('d/m/Y') }}</td>
                        <td>
                            @if($p->status === 'dipinjam')
                                @if($p->tanggal_kembali < now()->startOfDay())
                                    <span class="badge-modern badge-danger"><i class="fas fa-exclamation-circle"></i> Terlambat</span>
                                @else
                                    <span class="badge-modern badge-warning"><i class="fas fa-clock"></i> Dipinjam</span>
                                @endif
                            @elseif($p->status === 'terlambat')
                                <span class="badge-modern badge-danger"><i class="fas fa-exclamation-circle"></i> Terlambat</span>
                            @else
                                <span class="badge-modern badge-success"><i class="fas fa-check-circle"></i> Kembali</span>
                            @endif
                        </td>
                        <td style="font-weight:600; color: {{ $p->hitungDenda() > 0 ? 'var(--danger)' : 'var(--success)' }}">
                            Rp {{ number_format($p->hitungDenda(), 0, ',', '.') }}
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                @if($p->status === 'dipinjam' || ($p->status === 'terlambat' && !$p->tanggal_dikembalikan))
                                <form action="{{ route('peminjamans.kembalikan', $p) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn-modern btn-return btn-sm-modern" title="Kembalikan Buku">
                                        <i class="fas fa-undo"></i> Kembali
                                    </button>
                                </form>
                                @endif
                                <a href="{{ route('peminjamans.show', $p) }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-eye"></i></a>
                                <form id="delete-loan-{{ $p->id }}" action="{{ route('peminjamans.destroy', $p) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('delete-loan-{{ $p->id }}')" class="btn-modern btn-delete btn-sm-modern"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-hand-holding-heart"></i>
                                <p>Belum ada data transaksi</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($peminjamans->hasPages())
        <div class="mt-4">
            {{ $peminjamans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
