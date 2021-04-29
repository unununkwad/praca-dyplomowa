<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Event;
use App\Models\Additional_Data;
use App\Models\Disease;
use Carbon\Carbon;

class LekarzController extends Controller
{
    public function lekarz_profil($title)
    {
        $role = "lekarz";

        $users = User::with('roles')
                ->where('name', '=', $title)
                ->get();
        
        foreach ($users as $user){
            $events = Event::where('pacjent_id', '=', $user->id)
                    ->leftJoin('users', 'lekarz_id', '=', 'users.id')
                    ->orderBy('start', 'desc')
                    ->get();
            
            $additional_Data = Additional_Data::where('pacjent_id', '=', $user->id)->get();

            $disease = Disease::where('pacjent_id', '=', $user->id)
                    ->leftJoin('users', 'lekarz_id', '=', 'users.id')
                    ->get();
        }


        //dd($disease);

        $now = Carbon::now()->format('Y-m-d H:i:s');

        return view('profil_pacjenta', [
            'users' => $users,
            'events' => $events,
            'now' => $now,
            'additional_Data' => $additional_Data,
            'role' => $role,
            'disease' => $disease
        ]);
    }

}
