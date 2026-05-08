<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,petugas',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Notifikasi ke semua admin
        \Illuminate\Support\Facades\Notification::send(
            \App\Models\User::all(),
            new \App\Notifications\NewDataNotification([
                'id' => $user->id,
                'title' => 'User Baru Terdaftar',
                'message' => "User sistem baru bernama '{$user->name}' ({$user->role}) telah ditambahkan.",
                'url' => route('users.index'),
                'icon' => 'fas fa-cog',
                'color' => 'var(--primary)'
            ])
        );

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'role' => 'required|in:admin,petugas',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Notifikasi ke semua admin
        \Illuminate\Support\Facades\Notification::send(
            \App\Models\User::all(),
            new \App\Notifications\DataUpdatedNotification([
                'id' => $user->id,
                'title' => 'User Sistem Diubah',
                'message' => "Profil user '{$user->name}' telah diperbarui oleh sistem.",
                'url' => route('users.index'),
                'icon' => 'fas fa-cog',
                'color' => 'var(--secondary)'
            ])
        );

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}