<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional_Data extends Model
{
    use HasFactory;
    protected $table = 'additional_data';
    protected $fillable = [
        'pacjent_id','pesel','phone_number',
    ];
    
    public function users(){
        return $this->hasOne('App\Models\User');
    }
}
