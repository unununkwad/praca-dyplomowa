<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\WorkingHours;
use App\Models\Event;
use App\Models\Additional_Data;
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

        return redirect('/user/termin');
    }

    public function destroy($event_start, $user_name)
    {
        $event = Event::where('start',$event_start)->delete();
   
        //dd($event_id);
        Response::json($event);
        return back();
    }


    public function profil()
    {
        $id = Auth::id();
        $users = User::with('roles')
        ->where('id', '=', $id)
        ->get();
        
        $events = Event::where('pacjent_id', '=', "{$id}%")
        ->leftJoin('users', 'lekarz_id', '=', 'users.id')
        ->orderBy('start', 'desc')
        ->get();
        //dd($users);
        
        $additional_Data = Additional_Data::where('pacjent_id', '=', $id)->get();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        return view('profil_pacjenta', [
            'users' => $users,
            'events' => $events,
            'additional_Data' => $additional_Data,
            'now' => $now
        ]);
    }

    public function edit_Additional_Data(Request $request)
    {
        $id = Auth::id();
        $pesel = trim($request->get('pesel'));
        if($pesel == ""){
            $pesel = 0;
        }

        $phone_number = trim($request->get('phone_number'));
        if($phone_number == ""){
            $phone_number = 0;
        }

        $where = array('pacjent_id' => $id);
        $updateArr = [  'pacjent_id' => $id,
                        'pesel' => $pesel,
                        'phone_number' => $phone_number
                    ];
                    
        $additional_Data = Additional_Data::where($where)->get();
        
        if ($additional_Data->count() != 0) {
            $additional_Data = Additional_Data::where($where)->update($updateArr);
        } else {
            $additional_Data = Additional_Data::create($updateArr);
        }

        //dd($additional_Data);
        Response::json($additional_Data);
        return back();
    }

    public function lekarz_profil($title)
    {
        $role = "lekarz";

        $users = User::with('roles')
        ->where('name', '=', $title)
        ->get();
        
        foreach ($users as $user){
            $events = Event::where('pacjent_id', '=', "{$user->id}%")
            ->leftJoin('users', 'lekarz_id', '=', 'users.id')
            ->orderBy('start', 'desc')
            ->get();
            
            $additional_Data = Additional_Data::where('pacjent_id', '=', $user->$id)->get();
        }


        //dd($role);

        $now = Carbon::now()->format('Y-m-d H:i:s');

        return view('profil_pacjenta', [
            'users' => $users,
            'events' => $events,
            'now' => $now,
            'additional_Data' => $additional_Data,
            'role' => $role
        ]);
    }
}
