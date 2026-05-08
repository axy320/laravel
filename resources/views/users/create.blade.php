@extends('layouts.app')
@section('title', 'Tambah User')
@section('breadcrumb', 'Input data petugas baru')

@section('content')
<div class="modern-card fade-in" style="max-width:600px;">
    <div class="card-header-custom">
        <h5><i class="fas fa-user-plus me-2" style="color:var(--success)"></i>Tambah Petugas</h5>
        <a href="{{ route('users.index') }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body-custom">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label-modern">Nama Lengkap <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="name" class="form-modern" value="{{ old('name') }}" required placeholder="Nama lengkap petugas">
                </div>
                
                <div class="col-md-12">
                    <label class="form-label-modern">Alamat Email <span style="color:var(--danger)">*</span></label>
                    <input type="email" name="email" class="form-modern" value="{{ old('email') }}" required placeholder="email@contoh.com">
                </div>

                <div class="col-md-12">
                    <label class="form-label-modern">Password <span style="color:var(--danger)">*</span></label>
                    <input type="password" name="password" class="form-modern" required placeholder="Minimal 8 karakter">
                </div>

                <div class="col-md-12">
                    <label class="form-label-modern">Role / Hak Akses <span style="color:var(--danger)">*</span></label>
                    <select name="role" class="form-modern" required>
                        <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn-modern btn-add" style="width: 100%; justify-content: center;">
                        <i class="fas fa-save"></i> Daftarkan User
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection