{{-- Detail Siswa --}}
@extends('layouts.app')
@section('title', 'Detail Siswa')
@section('breadcrumb', 'Informasi lengkap siswa')

@section('content')
<div class="modern-card fade-in" style="max-width:700px;">
    <div class="card-header-custom">
        <h5><i class="fas fa-user me-2" style="color:var(--info)"></i>Detail Siswa</h5>
        <a href="{{ route('siswas.index') }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body-custom">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label-modern">Nama Siswa</label>
                <div class="form-modern" style="background:var(--body-bg);">{{ $siswa->nama_siswa }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label-modern">NIS</label>
                <div class="form-modern" style="background:var(--body-bg);">{{ $siswa->nis }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label-modern">Kelas</label>
                <div class="form-modern" style="background:var(--body-bg);">{{ $siswa->kelas }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label-modern">Jenis Kelamin</label>
                <div class="form-modern" style="background:var(--body-bg);">{{ $siswa->jenis_kelamin }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label-modern">No. HP</label>
                <div class="form-modern" style="background:var(--body-bg);">{{ $siswa->no_hp ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label-modern">Alamat</label>
                <div class="form-modern" style="background:var(--body-bg);">{{ $siswa->alamat ?? '-' }}</div>
            </div>
        </div>

        @if($siswa->peminjamans->count() > 0)
        <hr style="border-color:var(--border-color); margin:24px 0;">
        <h6 style="font-weight:700; margin-bottom:16px;"><i class="fas fa-history me-1"></i> Riwayat Peminjaman</h6>
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr><th>Buku</th><th>Tgl Pinjam</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @foreach($siswa->peminjamans as $p)
                    <tr>
                        <td>{{ $p->buku->judul_buku ?? 'N/A' }}</td>
                        <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td>
                            @if($p->status === 'dipinjam')
                                <span class="badge-modern badge-warning">Dipinjam</span>
                            @elseif($p->status === 'terlambat')
                                <span class="badge-modern badge-danger">Terlambat</span>
                            @else
                                <span class="badge-modern badge-success">Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection