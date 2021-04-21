<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\WorkingHours;
use App\Models\Event;
use Carbon\Carbon;
use Auth;
use Response;

class UserController extends Controller
{
    public function user()
    {
        $now = Carbon::now()->format('Y-m-d');
        //dd($now);
        $users = User::with('roles')->get();
        $DbDate = WorkingHours::where('start', 'LIKE', "{$now}%")
        ->leftJoin('users', 'user_id', '=', 'users.id')
        ->orderBy('start', 'asc')
        ->get();
        //dd($users);

        return view('user', [
            'users' => $users,
            'DbDate' => $DbDate
        ]);
    }

    public function search(Request $request)
    {
        $users = User::with('roles')->get();
        $lekarz = trim($request->get('lekarz'));
        $Date = trim($request->get('Date'));


        if ($lekarz == "Dowolny" && $Date == NULL){
            $DbDate = WorkingHours::leftJoin('users', 'user_id', '=', 'users.id')
            ->orderBy('start', 'asc')
            ->get();
        }
        else if ($lekarz == "Dowolny"){
            $DbDate = WorkingHours::where('start', 'LIKE', "{$Date}%")
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->orderBy('start', 'asc')
            ->get();
        }
        else if ($Date == NULL){
            $DbDate = WorkingHours::where('name', '=', $lekarz)
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->orderBy('start', 'asc')
            ->get();
        }
        else{
            $DbDate = WorkingHours::where('name', '=', $lekarz)
            ->where('start', 'LIKE', "{$Date}%")
            ->orderBy('start', 'asc')
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->get();
        }

        //dd($DbData);


        //Date("Y:M:s", strtotime("30 minutes", strtotime($Date->time)));
        return view('user', [
            'users' => $users,
            'DbDate' => $DbDate
        ]);
    }


    public function addEvent($lekarz, $start)
    {
        //dd($lekarz);
        $end = date("Y-m-d H:i:s", strtotime($start) + 15 * 60);
        $id = Auth::id();
        $pacjent = Auth::user()->name;
        $insertArr = [ 'title' => $pacjent,
                       'start' => $start,
                       'end' => $end,
                       'lekarz_id' => $lekarz,
                       'pacjent_id' => $id
                    ];
        $event = Event::insert($insertArr);   
        Response::json($event);

        return redirect('/user');
    }

}
