@extends('layouts.app')
@section('title', 'Pinjam Buku')
@section('breadcrumb', 'Input transaksi peminjaman baru')

@section('content')
<div class="modern-card fade-in" style="max-width:700px;">
    <div class="card-header-custom">
        <h5><i class="fas fa-plus-circle me-2" style="color:var(--success)"></i>Transaksi Pinjam</h5>
        <a href="{{ route('peminjamans.index') }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body-custom">
        <form action="{{ route('peminjamans.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label-modern">Nama Peminjam (Siswa/Pengunjung) <span style="color:var(--danger)">*</span></label>
                    <input list="peminjam_list" name="nama_peminjam" class="form-modern" value="{{ old('nama_peminjam') }}" required placeholder="Ketik nama...">
                    <datalist id="peminjam_list">
                        @foreach($semuaPeminjam as $nama)
                            <option value="{{ $nama }}">
                        @endforeach
                    </datalist>
                    <small class="text-muted">Ketik nama Siswa atau Pengunjung yang sudah terdaftar.</small>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label-modern">Pilih Buku <span style="color:var(--danger)">*</span></label>
                    <select name="buku_id" class="form-modern" required>
                        <option value="">-- Pilih Buku (Tersedia) --</option>
                        @foreach($bukus as $b)
                            <option value="{{ $b->id }}" {{ old('buku_id') == $b->id ? 'selected' : '' }} {{ $b->stok_buku <= 0 ? 'disabled' : '' }}>
                                {{ $b->kode_buku }} - {{ $b->judul_buku }} (Stok: {{ $b->stok_buku }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern">Jumlah Pinjam <span style="color:var(--danger)">*</span></label>
                    <input type="number" name="jumlah_pinjam" class="form-modern" value="{{ old('jumlah_pinjam', 1) }}" required min="1">
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern">Tanggal Pinjam <span style="color:var(--danger)">*</span></label>
                    <input type="date" name="tanggal_pinjam" class="form-modern" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern">Batas Kembali (Deadline) <span style="color:var(--danger)">*</span></label>
                    <input type="date" name="tanggal_kembali" class="form-modern" value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+7 days'))) }}" required>
                    <small class="text-muted">Default: 7 Hari. Silakan sesuaikan jika diperlukan.</small>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn-modern btn-add" style="width: 100%; justify-content: center;">
                        <i class="fas fa-check-circle"></i> Konfirmasi Peminjaman
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection