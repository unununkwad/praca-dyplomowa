<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;
    protected $fillable = [
        'wywiad','nr_choroby','czy_pierwsze_zachorowanie','poczatek_choroby','koniec_choroby','lekarz_id','pacjent_id',
    ];
}
