<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Models\Event;
use App\Models\User;
use App\Models\Role;
use Response;
 
use Calendar;
 
class EventController extends Controller
{

    public function index()
    {
        $users = User::with('roles')->get();
        //dd($users);


        if(request()->ajax()) 
        {
         $id = Auth::id();
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
         $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->where('lekarz_id', '=', $id)->get(['id','title','start', 'end']);
         return Response::json($data);
        }
        return view('lekarz', ['users' => $users]);
    }
    
   
    public function create(Request $request)
    {
        $insertArr = [ 'title' => $request->title,
                       'start' => $request->start,
                       'end' => $request->end
                    ];
        $event = Event::insert($insertArr);   
        return Response::json($event);
    }
     
 
    public function update(Request $request)
    {   
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);
 
        return Response::json($event);
    } 






 
 
}