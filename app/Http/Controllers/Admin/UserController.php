<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:super_admin,supervisor,front_desk,user',
        ]);

        $user->update(['role' => $request->role]);
        return back()->with('success', "User role updated to {$request->role}.");
    }
}
