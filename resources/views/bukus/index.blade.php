@extends('layouts.app')
@section('title', 'Data Buku')
@section('breadcrumb', 'Katalog buku perpustakaan')

@section('content')
<div class="modern-card fade-in">
    <div class="card-header-custom">
        <h5><i class="fas fa-book me-2" style="color:var(--primary)"></i>Manajemen Katalog Buku</h5>
        <a href="{{ route('bukus.create') }}" class="btn-modern btn-add">
            <i class="fas fa-plus"></i> Tambah Buku
        </a>
    </div>
    <div class="card-body-custom">
        <form action="{{ route('bukus.index') }}" method="GET" class="mb-4">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="search" class="form-modern" placeholder="Cari judul, kode, atau penulis..." value="{{ $search ?? '' }}">
            </div>
        </form>

        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Rak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bukus as $b)
                    <tr>
                        <td><span class="badge-modern badge-primary">{{ $b->kode_buku }}</span></td>
                        <td style="font-weight:600; max-width: 250px;" class="text-truncate">{{ $b->judul_buku }}</td>
                        <td>{{ $b->penulis }}</td>
                        <td><span class="badge-modern badge-info">{{ $b->kategori }}</span></td>
                        <td>
                            @if($b->stok_buku > 0)
                                <span class="badge-modern badge-success"><i class="fas fa-check"></i> {{ $b->stok_buku }} Tersedia</span>
                            @else
                                <span class="badge-modern badge-danger"><i class="fas fa-times"></i> Habis</span>
                            @endif
                        </td>
                        <td><span class="badge-modern" style="background:var(--body-bg); color:var(--text-secondary);">{{ $b->rak_buku ?? '-' }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('bukus.show', $b) }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('bukus.edit', $b) }}" class="btn-modern btn-edit btn-sm-modern"><i class="fas fa-edit"></i></a>
                                <form id="delete-{{ $b->id }}" action="{{ route('bukus.destroy', $b) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('delete-{{ $b->id }}')" class="btn-modern btn-delete btn-sm-modern"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-book"></i>
                                <p>Belum ada koleksi buku</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($bukus->hasPages())
        <div class="mt-4">
            {{ $bukus->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
