{{-- Daftar Siswa - Index --}}
@extends('layouts.app')
@section('title', 'Data Siswa')
@section('breadcrumb', 'Kelola data siswa perpustakaan')

@section('content')
<div class="modern-card fade-in">
    <div class="card-header-custom">
        <h5><i class="fas fa-user-graduate me-2" style="color:var(--primary)"></i>Data Siswa</h5>
        <a href="{{ route('siswas.create') }}" class="btn-modern btn-add">
            <i class="fas fa-plus"></i> Tambah Siswa
        </a>
    </div>
    <div class="card-body-custom">
        <!-- Search -->
        <form action="{{ route('siswas.index') }}" method="GET" class="mb-4">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="search" class="form-modern" placeholder="Cari nama, NIS, atau kelas..." value="{{ $search ?? '' }}">
            </div>
        </form>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $key => $siswa)
                    <tr>
                        <td>{{ $siswas->firstItem() + $key }}</td>
                        <td style="font-weight:600;">{{ $siswa->nama_siswa }}</td>
                        <td><span class="badge-modern badge-primary">{{ $siswa->nis }}</span></td>
                        <td>{{ $siswa->kelas }}</td>
                        <td>
                            @if($siswa->jenis_kelamin === 'Laki-laki')
                                <span class="badge-modern badge-info"><i class="fas fa-mars"></i> {{ $siswa->jenis_kelamin }}</span>
                            @else
                                <span class="badge-modern" style="background:rgba(236,72,153,0.1); color:#be185d;"><i class="fas fa-venus"></i> {{ $siswa->jenis_kelamin }}</span>
                            @endif
                        </td>
                        <td>{{ $siswa->no_hp ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('siswas.show', $siswa) }}" class="btn-modern btn-detail btn-sm-modern"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('siswas.edit', $siswa) }}" class="btn-modern btn-edit btn-sm-modern"><i class="fas fa-edit"></i></a>
                                <form id="delete-{{ $siswa->id }}" action="{{ route('siswas.destroy', $siswa) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('delete-{{ $siswa->id }}')" class="btn-modern btn-delete btn-sm-modern"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-user-graduate"></i>
                                <p>Belum ada data siswa</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($siswas->hasPages())
        <div class="d-flex justify-content-center">
            {{ $siswas->links('vendor.pagination.custom') }}
        </div>
        @endif
    </div>
</div>
@endsection