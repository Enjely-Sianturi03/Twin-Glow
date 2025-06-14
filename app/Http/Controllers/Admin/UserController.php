<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // SELECT * FROM users;
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function update(Request $request, $id) 
    {
        // SELECT * FROM users WHERE id = $id LIMIT 1;
        $user = User::findOrFail($id);
        // UPDATE users SET name = '$request->name', email = '$request->email', updated_at = NOW() WHERE id = $id;
        $user->update($request->only('name', 'email'));
        return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui');
    }

    public function destroy($id) 
    {
        // SELECT * FROM users WHERE id = $id LIMIT 1;
        $user = User::findOrFail($id);
        // DELETE FROM users WHERE id = $id;
        $user->delete();
        return redirect()->back()->with('success', 'Data pengguna berhasil dihapus');
    }

public function toggleBlock($id)
{
    $user = User::findOrFail($id);
    $user->is_blocked = !$user->is_blocked; // toggle
    $user->save();

    return back()->with('success', 'Status user berhasil diubah.');
}
}

