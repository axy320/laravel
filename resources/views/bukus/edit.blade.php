@extends('layouts.app')
@section('title', 'Edit Buku')
@section('breadcrumb', 'Ubah informasi buku')

@section('content')
<div class="modern-card fade-in" style="max-width:800px;">
    <div class="card-header-custom">
        <h5><i class="fas fa-edit me-2" style="color:var(--warning)"></i>Edit Buku</h5>
        <a href="{{ route('bukus.index') }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body-custom">
        <form action="{{ route('bukus.update', $buku) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label-modern">Kode Buku <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="kode_buku" class="form-modern" value="{{ old('kode_buku', $buku->kode_buku) }}" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label-modern">Judul Buku <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="judul_buku" class="form-modern" value="{{ old('judul_buku', $buku->judul_buku) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">Penulis <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="penulis" class="form-modern" value="{{ old('penulis', $buku->penulis) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">Penerbit</label>
                    <input type="text" name="penerbit" class="form-modern" value="{{ old('penerbit', $buku->penerbit) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label-modern">Tahun Terbit <span style="color:var(--danger)">*</span></label>
                    <input type="number" name="tahun_terbit" class="form-modern" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" required min="1900" max="{{ date('Y') + 1 }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label-modern">Kategori <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="kategori" class="form-modern" value="{{ old('kategori', $buku->kategori) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label-modern">Stok <span style="color:var(--danger)">*</span></label>
                    <input type="number" name="stok_buku" class="form-modern" value="{{ old('stok_buku', $buku->stok_buku) }}" required min="0">
                </div>
                <div class="col-md-12">
                    <label class="form-label-modern">Lokasi Rak</label>
                    <input type="text" name="rak_buku" class="form-modern" value="{{ old('rak_buku', $buku->rak_buku) }}">
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn-modern btn-edit"><i class="fas fa-save"></i> Perbarui Buku</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection