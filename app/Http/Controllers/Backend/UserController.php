<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('backend.pages.user.index', compact('users'));
    }

    public function edit(User $user)
    {
        $firstRole = $user->roles->first();

        if ($firstRole && $firstRole->name == 'admin') {
            $user->removeRole('admin');
        } else {
            $user->addRole('admin');
        }
        return redirect()->route('admin.user.index');
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while deleting the user');
        }
        return redirect()->route('admin.user.index')->with('success', 'user deleted successfully');
    }
}
