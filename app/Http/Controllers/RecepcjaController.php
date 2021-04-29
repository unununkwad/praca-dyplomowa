<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Additional_Data;
use App\Models\Event;
use App\Models\WorkingHours;
use Carbon\Carbon;
use Response;


class RecepcjaController extends Controller
{
    public function search(Request $request)
    {
        $role = "recepcja";
        $pesel = trim($request->get('pesel'));
        if($pesel == ""){
            $pesel = 0;
        }


        $users = Additional_Data::where('pesel', '=', $pesel)
                ->join('users', 'pacjent_id', '=', 'users.id')
                ->get();
        
        if(count($users)==0){
            $brak_wyniku = "brak_wyniku";
            return view('recepcja', [
                'brak_wyniku' => $brak_wyniku,
                'pesel' => $pesel
            ]);
        }

        foreach($users as $user){
            $events = Event::where('pacjent_id', '=', $user->id)
                    ->leftJoin('users', 'lekarz_id', '=', 'users.id')
                    ->orderBy('start', 'desc')
                    ->get();
            //dd($users);
            
            $additional_Data = Additional_Data::where('pacjent_id', '=', $user->id)->get();
        }
        $now = Carbon::now()->format('Y-m-d H:i:s');

        return view('profil_pacjenta', [
            'users' => $users,
            'events' => $events,
            'additional_Data' => $additional_Data,
            'now' => $now,
            'role' => $role
        ]);
    }

    public function back_to_profil($pesel)
    {
        $role = "recepcja";
        if($pesel == ""){
            $pesel = 0;
        }


        $users = Additional_Data::where('pesel', '=', $pesel)
                ->join('users', 'pacjent_id', '=', 'users.id')
                ->get();
        
        if(count($users)==0){
            $brak_wyniku = "brak_wyniku";
            return view('recepcja', [
                'brak_wyniku' => $brak_wyniku,
                'pesel' => $pesel
            ]);
        }

        foreach($users as $user){
            $events = Event::where('pacjent_id', '=', $user->id)
                    ->leftJoin('users', 'lekarz_id', '=', 'users.id')
                    ->orderBy('start', 'desc')
                    ->get();
            //dd($users);
            
            $additional_Data = Additional_Data::where('pacjent_id', '=', $user->id)->get();
        }
        $now = Carbon::now()->format('Y-m-d H:i:s');

        return view('profil_pacjenta', [
            'users' => $users,
            'events' => $events,
            'additional_Data' => $additional_Data,
            'now' => $now,
            'role' => $role
        ]);
    }

    public function terminy($pesel)
    {
        $now = Carbon::now()->format('Y-m-d');
        $users = User::with('roles')->get();
        $DbDate = WorkingHours::where('start', 'LIKE', "{$now}%")
                ->leftJoin('users', 'user_id', '=', 'users.id')
                ->orderBy('start', 'asc')
                ->get();
        return view('szukanie_terminu', [
            'users' => $users,
            'DbDate' => $DbDate,
            'pesel' => $pesel
        ]);
    }

    public function szukanie_terminu($pesel, Request $request)
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
        return view('szukanie_terminu', [
            'users' => $users,
            'DbDate' => $DbDate,
            'pesel' => $pesel
        ]);
    }

    public function add_Event($lekarz, $start, $pesel)
    {
        //dd($lekarz);
        $end = date("Y-m-d H:i:s", strtotime($start) + 15 * 60);
        $additional_Data = Additional_Data::where('pesel', '=', $pesel)->get();
        foreach($additional_Data as $additional_Data1){
            $users = User::where('id', '=', $additional_Data1->pacjent_id)->get();
        }
        
        foreach($users as $user){
        $id = $user->id;
        $pacjent = $user->name;
        }

        $insertArr = [ 'title' => $pacjent,
                       'start' => $start,
                       'end' => $end,
                       'lekarz_id' => $lekarz,
                       'pacjent_id' => $id
                    ];
        $event = Event::insert($insertArr);   
        Response::json($event);

        return redirect('/recepcja/termin/$pesel');
    }

    public function delete_Event($event_start, $user_name)
    {
        $event = Event::where('start',$event_start)->delete();
   
        //dd($event_id);
        Response::json($event);
        return back();
    }
}
