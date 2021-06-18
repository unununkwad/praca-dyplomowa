<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin', ['users' => $users]);
    }
    
    public function dashboard()
    {
        $user_id = Auth::id();
        $users = User::with('roles')
                ->where('id', '=', $user_id)
                ->get();
        foreach($users as $user){
            if($user->hasRole('admin')){
                return view('dashboard');
            }
            else if($user->hasRole('lekarz')){
                return redirect('/lekarz');
            }
            else if($user->hasRole('recepcja')){
                return redirect('/recepcja');
            }
            else{
                return redirect('/pacjent/profil');
            }

        }
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
