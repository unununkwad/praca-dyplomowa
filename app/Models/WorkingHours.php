<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Response;

class WorkingHours extends Model
{
    use HasFactory;
    protected $fillable = [
        'start','end','user_id'
    ];

    public function add15Min(){
        $start = $this->start;
        $end = $this->end;
        $Dates = array();
        $pomocnicza = $start;
        $now = date("Y-m-d H:i:s", strtotime(Carbon::now()->format('Y-m-d H:i:s')) + 2 * 3600);
        
        if($end > $now){
            while ($pomocnicza < $end){
                
                $data = Event::where('start', '=', $pomocnicza)->get(['id','title','start', 'end']);
                while (sizeof($data) > 0 || $now >= $pomocnicza){
                    $pomocnicza = date("Y-m-d H:i:s", strtotime($pomocnicza) + 15 * 60);
                    $data = Event::whereDate('start', '=', $pomocnicza)->get(['id','title','start', 'end']);
                }
                $Dates[] = $pomocnicza;
                $pomocnicza = date("Y-m-d H:i:s", strtotime($pomocnicza) + 15 * 60);
            }
        }
        //dd($data);
        
        return $Dates;
    }


}
