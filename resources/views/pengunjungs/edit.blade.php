@extends('layouts.app')
@section('title', 'Edit Pengunjung')
@section('breadcrumb', 'Ubah data kunjungan')

@section('content')
<div class="modern-card fade-in" style="max-width:700px;">
    <div class="card-header-custom">
        <h5><i class="fas fa-edit me-2" style="color:var(--warning)"></i>Edit Pengunjung</h5>
        <a href="{{ route('pengunjungs.index') }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body-custom">
        <form action="{{ route('pengunjungs.update', $pengunjung) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label-modern">Nama Pengunjung <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="nama_pengunjung" class="form-modern" value="{{ old('nama_pengunjung', $pengunjung->nama_pengunjung) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">No. HP</label>
                    <input type="text" name="no_hp" class="form-modern" value="{{ old('no_hp', $pengunjung->no_hp) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">Tanggal Register <span style="color:var(--danger)">*</span></label>
                    <input type="date" name="tanggal_kunjungan" class="form-modern" value="{{ old('tanggal_kunjungan', \Carbon\Carbon::parse($pengunjung->tanggal_kunjungan)->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label-modern">Keperluan <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="keperluan" class="form-modern" value="{{ old('keperluan', $pengunjung->keperluan) }}" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label-modern">Alamat</label>
                    <textarea name="alamat" class="form-modern" rows="3">{{ old('alamat', $pengunjung->alamat) }}</textarea>
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn-modern btn-edit"><i class="fas fa-save"></i> Update Data</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
