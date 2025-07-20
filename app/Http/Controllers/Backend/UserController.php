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

        try {
            $firstRole = $user->roles->first();

            if ($firstRole && $firstRole->name == 'admin') {
                $user->removeRole('admin');
            } else {
                $user->addRole('admin');
            }
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Failed!',
                'message' => 'An error occurred ',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(User $user)
    {
       try {
            $user->delete();
            return response()->json([
                'success' => true,
                'title' => 'Deleted!',
                'message' => 'User has been deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Delete Failed',
                'message' => 'Something went wrong while deleting the user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
