<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\WorkingHours;

class UserController extends Controller
{
    public function user()
    {
        $users = User::with('roles')->get();
        $DbData = WorkingHours::leftJoin('users', 'user_id', '=', 'users.id')->get();
        //dd($users);

        return view('user', [
            'users' => $users,
            'DbData' => $DbData
        ]);
    }

    public function search(Request $request)
    {
        $users = User::with('roles')->get();
        $lekarz = trim($request->get('lekarz'));
        $Date = trim($request->get('Date'));

        $DbData = WorkingHours::where('name', '=', $lekarz)
            ->where('start', 'LIKE', "{$Date}%")
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->get();
        //dd($DbData);


        //Date("Y:M:s", strtotime("30 minutes", strtotime($Date->time)));
        return view('user', [
            'users' => $users,
            'DbData' => $DbData
        ]);
    }
}
