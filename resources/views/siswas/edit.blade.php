{{-- Edit Siswa --}}
@extends('layouts.app')
@section('title', 'Edit Siswa')
@section('breadcrumb', 'Edit data siswa')

@section('content')
<div class="modern-card fade-in" style="max-width:700px;">
    <div class="card-header-custom">
        <h5><i class="fas fa-edit me-2" style="color:var(--warning)"></i>Edit Siswa</h5>
        <a href="{{ route('siswas.index') }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body-custom">
        <form action="{{ route('siswas.update', $siswa) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label-modern">Nama Siswa <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="nama_siswa" class="form-modern" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">NIS <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="nis" class="form-modern" value="{{ old('nis', $siswa->nis) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">Kelas <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="kelas" class="form-modern" value="{{ old('kelas', $siswa->kelas) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">Jenis Kelamin <span style="color:var(--danger)">*</span></label>
                    <select name="jenis_kelamin" class="form-modern" required>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">No. HP</label>
                    <input type="text" name="no_hp" class="form-modern" value="{{ old('no_hp', $siswa->no_hp) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">Alamat</label>
                    <input type="text" name="alamat" class="form-modern" value="{{ old('alamat', $siswa->alamat) }}">
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn-modern btn-edit"><i class="fas fa-save"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection