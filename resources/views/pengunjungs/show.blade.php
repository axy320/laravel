{{-- Detail Pengunjung --}}
@extends('layouts.app')
@section('title', 'Detail Pengunjung')
@section('breadcrumb', 'Informasi kunjungan')

@section('content')
<div class="modern-card fade-in" style="max-width:700px;">
    <div class="card-header-custom">
        <h5><i class="fas fa-user me-2" style="color:var(--info)"></i>Detail Pengunjung</h5>
        <a href="{{ route('pengunjungs.index') }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body-custom">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label-modern">Nama Pengunjung</label>
                <div class="form-modern" style="background:var(--body-bg);">{{ $pengunjung->nama_pengunjung }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label-modern">Tanggal Kunjungan</label>
                <div class="form-modern" style="background:var(--body-bg);">{{ \Carbon\Carbon::parse($pengunjung->tanggal_kunjungan)->format('d/m/Y') }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label-modern">No. HP</label>
                <div class="form-modern" style="background:var(--body-bg);">{{ $pengunjung->no_hp ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label-modern">Keperluan</label>
                <div class="form-modern" style="background:var(--body-bg);"><span class="badge-modern badge-info">{{ $pengunjung->keperluan }}</span></div>
            </div>
            <div class="col-12">
                <label class="form-label-modern">Alamat</label>
                <div class="form-modern" style="background:var(--body-bg);">{{ $pengunjung->alamat ?? '-' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
