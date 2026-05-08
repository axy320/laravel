@extends('layouts.app')
@section('title', 'Edit Peminjaman')
@section('breadcrumb', 'Ubah data transaksi peminjaman')

@section('content')
<div class="modern-card fade-in" style="max-width:700px;">
    <div class="card-header-custom">
        <h5><i class="fas fa-edit me-2" style="color:var(--warning)"></i>Ubah Peminjaman</h5>
        <a href="{{ route('peminjamans.index') }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body-custom">
        <form action="{{ route('peminjamans.update', $peminjaman) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label-modern">Nama Peminjam (Siswa/Pengunjung) <span style="color:var(--danger)">*</span></label>
                    @php
                        $namaAktual = $peminjaman->siswa_id 
                                        ? ($peminjaman->siswa->nama_siswa ?? '') 
                                        : ($peminjaman->pengunjung->nama_pengunjung ?? '');
                    @endphp
                    <input list="peminjam_list" name="nama_peminjam" class="form-modern" value="{{ old('nama_peminjam', $namaAktual) }}" required placeholder="Ketik nama...">
                    <datalist id="peminjam_list">
                        @foreach($semuaPeminjam as $nama)
                            <option value="{{ $nama }}">
                        @endforeach
                    </datalist>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label-modern">Buku <span style="color:var(--danger)">*</span></label>
                    <select name="buku_id" class="form-modern" required>
                        @foreach($bukus as $b)
                            <option value="{{ $b->id }}" {{ old('buku_id', $peminjaman->buku_id) == $b->id ? 'selected' : '' }}>
                                {{ $b->kode_buku }} - {{ $b->judul_buku }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern">Jumlah Pinjam <span style="color:var(--danger)">*</span></label>
                    <input type="number" name="jumlah_pinjam" class="form-modern" value="{{ old('jumlah_pinjam', $peminjaman->jumlah_pinjam) }}" required min="1">
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern">Status <span style="color:var(--danger)">*</span></label>
                    <select name="status" class="form-modern" required>
                        <option value="dipinjam" {{ old('status', $peminjaman->status) == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="dikembalikan" {{ old('status', $peminjaman->status) == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        <option value="terlambat" {{ old('status', $peminjaman->status) == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern">Tanggal Pinjam <span style="color:var(--danger)">*</span></label>
                    <input type="date" name="tanggal_pinjam" class="form-modern" value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam->format('Y-m-d')) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern">Batas Kembali <span style="color:var(--danger)">*</span></label>
                    <input type="date" name="tanggal_kembali" class="form-modern" value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali->format('Y-m-d')) }}" required>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn-modern btn-edit" style="width: 100%; justify-content: center;">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection