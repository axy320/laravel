{{-- Tambah Siswa --}}
@extends('layouts.app')
@section('title', 'Tambah Siswa')
@section('breadcrumb', 'Tambah data siswa baru')

@section('content')
<div class="modern-card fade-in" style="max-width:700px;">
    <div class="card-header-custom">
        <h5><i class="fas fa-plus-circle me-2" style="color:var(--success)"></i>Tambah Siswa</h5>
        <a href="{{ route('siswas.index') }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body-custom">
        <form action="{{ route('siswas.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label-modern">Nama Siswa <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="nama_siswa" class="form-modern" value="{{ old('nama_siswa') }}" required placeholder="Masukkan nama lengkap">
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">NIS <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="nis" class="form-modern" value="{{ old('nis') }}" required placeholder="Nomor Induk Siswa">
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">Kelas <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="kelas" class="form-modern" value="{{ old('kelas') }}" required placeholder="Contoh: X RPL 1">
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">Jenis Kelamin <span style="color:var(--danger)">*</span></label>
                    <select name="jenis_kelamin" class="form-modern" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">No. HP</label>
                    <input type="text" name="no_hp" class="form-modern" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx">
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">Alamat</label>
                    <input type="text" name="alamat" class="form-modern" value="{{ old('alamat') }}" placeholder="Alamat lengkap">
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn-modern btn-add"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection