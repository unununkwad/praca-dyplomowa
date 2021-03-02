<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class LekarzController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        //dd($users);
        return view('lekarz', ['users' => $users]);
    }
}
