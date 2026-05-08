@extends('layouts.app')

@section('content')

<h3>Edit User</h3>

<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Password (kosongkan jika tidak ingin mengubah)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label>Role</label>
        <select name="role" class="form-control" required>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection