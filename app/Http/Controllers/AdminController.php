<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        //dd($users);
        return view('admin', ['users' => $users]);
    }

    public function user()
    {
        $users = User::with('roles')->get();
        //dd($users);
        return view('user', ['users' => $users]);
    }

    public function giveAdmin($userId)
    {
        $user = User::where('id', $userId)->firstorFail();

        $adminRole = Role::where('name', 'admin')->FirstorFail();

        $user->roles()->attach($adminRole->id);

        return redirect('/admin');
    }

    public function removeAdmin($userId)
    {
        $user = User::where('id', $userId)->firstorFail();

        $adminRole = Role::where('name', 'admin')->FirstorFail();

        $user->roles()->detach($adminRole->id);

        return redirect('/admin');
    }

    public function giveLekarz($userId)
    {
        $user = User::where('id', $userId)->firstorFail();

        $lekarzRole = Role::where('name', 'lekarz')->FirstorFail();

        $user->roles()->attach($lekarzRole->id);

        return redirect('/admin');
    }

    public function removeLekarz($userId)
    {
        $user = User::where('id', $userId)->firstorFail();

        $lekarzRole = Role::where('name', 'lekarz')->FirstorFail();

        $user->roles()->detach($lekarzRole->id);

        return redirect('/admin');
    }

    public function giveRecepcja($userId)
    {
        $user = User::where('id', $userId)->firstorFail();

        $recepcjaRole = Role::where('name', 'recepcja')->FirstorFail();

        $user->roles()->attach($recepcjaRole->id);

        return redirect('/admin');
    }

    public function removeRecepcja($userId)
    {
        $user = User::where('id', $userId)->firstorFail();

        $recepcjaRole = Role::where('name', 'recepcja')->FirstorFail();

        $user->roles()->detach($recepcjaRole->id);

        return redirect('/admin');
    }
}
