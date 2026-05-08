@extends('layouts.app')
@section('title', 'Data Pengunjung')
@section('breadcrumb', 'Daftar kunjungan perpustakaan')

@section('content')
<div class="modern-card fade-in">
    <div class="card-header-custom">
        <h5><i class="fas fa-users me-2" style="color:var(--primary)"></i>Data Pengunjung</h5>
        <a href="{{ route('pengunjungs.create') }}" class="btn-modern btn-add">
            <i class="fas fa-plus"></i> Tambah Pengunjung
        </a>
    </div>
    <div class="card-body-custom">
        <form action="{{ route('pengunjungs.index') }}" method="GET" class="mb-4">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="search" class="form-modern" placeholder="Cari nama atau keperluan..." value="{{ $search ?? '' }}">
            </div>
        </form>

        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pengunjung</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                        <th>Keperluan</th>
                        <th>Tgl Register</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengunjungs as $key => $p)
                    <tr>
                        <td>{{ $pengunjungs->firstItem() + $key }}</td>
                        <td style="font-weight:600;">{{ $p->nama_pengunjung }}</td>
                        <td>{{ $p->alamat ?? '-' }}</td>
                        <td>{{ $p->no_hp ?? '-' }}</td>
                        <td><span class="badge-modern badge-info">{{ $p->keperluan }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_kunjungan)->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('pengunjungs.show', $p) }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('pengunjungs.edit', $p) }}" class="btn-modern btn-edit btn-sm-modern"><i class="fas fa-edit"></i></a>
                                <form id="delete-{{ $p->id }}" action="{{ route('pengunjungs.destroy', $p) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('delete-{{ $p->id }}')" class="btn-modern btn-delete btn-sm-modern"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <p>Belum ada data pengunjung</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pengunjungs->hasPages())
        <div class="mt-4">
            {{ $pengunjungs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
