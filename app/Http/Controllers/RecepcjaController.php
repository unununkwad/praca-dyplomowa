<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Additional_Data;
use App\Models\Event;
use Carbon\Carbon;


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
}
