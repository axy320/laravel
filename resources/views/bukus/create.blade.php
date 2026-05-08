@extends('layouts.app')
@section('title', 'Tambah Buku')
@section('breadcrumb', 'Input koleksi buku baru')

@section('content')
<div class="modern-card fade-in" style="max-width:800px;">
    <div class="card-header-custom">
        <h5><i class="fas fa-plus-circle me-2" style="color:var(--success)"></i>Tambah Buku</h5>
        <a href="{{ route('bukus.index') }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body-custom">
        <form action="{{ route('bukus.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label-modern">Kode Buku <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="kode_buku" class="form-modern" value="{{ old('kode_buku', $nextKode ?? '') }}" required placeholder="Contoh: BPK1" readonly style="background-color:#e9ecef; cursor:not-allowed;">
                </div>
                <div class="col-md-8">
                    <label class="form-label-modern">Judul Buku <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="judul_buku" class="form-modern" value="{{ old('judul_buku') }}" required placeholder="Masukkan judul lengkap buku">
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">Penulis <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="penulis" class="form-modern" value="{{ old('penulis') }}" required placeholder="Nama penulis">
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">Penerbit</label>
                    <input type="text" name="penerbit" class="form-modern" value="{{ old('penerbit') }}" placeholder="Nama penerbit">
                </div>
                <div class="col-md-4">
                    <label class="form-label-modern">Tahun Terbit <span style="color:var(--danger)">*</span></label>
                    <input type="number" name="tahun_terbit" class="form-modern" value="{{ old('tahun_terbit', date('Y')) }}" required min="1900" max="{{ date('Y') + 1 }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label-modern">Kategori <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="kategori" class="form-modern" value="{{ old('kategori') }}" required placeholder="Contoh: Novel, Sains, dll">
                </div>
                <div class="col-md-4">
                    <label class="form-label-modern">Stok <span style="color:var(--danger)">*</span></label>
                    <input type="number" name="stok_buku" class="form-modern" value="{{ old('stok_buku', 0) }}" required min="0">
                </div>
                <div class="col-md-12">
                    <label class="form-label-modern">Lokasi Rak</label>
                    <input type="text" name="rak_buku" class="form-modern" value="{{ old('rak_buku') }}" placeholder="Contoh: A-1, B-2">
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn-modern btn-add"><i class="fas fa-save"></i> Simpan Buku</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection