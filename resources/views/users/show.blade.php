@extends('layouts.app')

@section('content')

<h3>Detail User</h3>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $user->name }}</h5>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
    </div>
</div>

<a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>

@endsection