@extends('layouts.app')
@section('title', 'Manajemen User')
@section('breadcrumb', 'Kelola hak akses petugas perpustakaan')

@section('content')
<div class="modern-card fade-in">
    <div class="card-header-custom">
        <h5><i class="fas fa-users-cog me-2" style="color:var(--primary)"></i>Hak Akses Petugas</h5>
        <a href="{{ route('users.create') }}" class="btn-modern btn-add">
            <i class="fas fa-plus"></i> Tambah User
        </a>
    </div>
    <div class="card-body-custom">
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <div class="user-avatar" style="width: 40px; height: 40px; font-size: 16px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        </td>
                        <td style="font-weight:600;">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="badge-modern badge-primary"><i class="fas fa-shield-alt"></i> Administrator</span>
                            @else
                                <span class="badge-modern badge-info"><i class="fas fa-user-check"></i> Petugas</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge-modern badge-success"><i class="fas fa-dot-circle"></i> Aktif</span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('users.edit', $user) }}" class="btn-modern btn-edit btn-sm-modern"><i class="fas fa-edit"></i></a>
                                @if(Auth::id() !== $user->id)
                                <form id="delete-user-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('delete-user-{{ $user->id }}')" class="btn-modern btn-delete btn-sm-modern"><i class="fas fa-trash"></i></button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="empty-state">
                                <i class="fas fa-users-slash"></i>
                                <p>Belum ada data user tambahan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
