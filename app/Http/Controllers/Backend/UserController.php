<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

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
        toast()->position('top');

        try {
            $user->delete();
            toast()->position('top');

            Alert::success('Deleted', $user->name . ' deleted successfully')->autoClose(8000);
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong while deleting the user')->autoClose(8000);
        }

        return redirect()->route('admin.user.index');
    }
}
