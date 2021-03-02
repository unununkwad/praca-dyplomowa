<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Models\WorkingHours;
use Response;
 
use Calendar;
 
class WorkingHoursController extends Controller
{

    public function index()
    {
        if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
         $data = WorkingHours::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','start', 'end']);
         return Response::json($data);
        }
        return view('working-hours');
    }
    
   
    public function create(Request $request)
    {
        $insertArr = [ 'start' => $request->start,
                       'end' => $request->end
                    ];
        $event = WorkingHours::insert($insertArr);   
        return Response::json($event);
    }
     
 
    public function update(Request $request)
    {   
        $where = array('id' => $request->id);
        $updateArr = ['start' => $request->start, 'end' => $request->end];
        $event  = WorkingHours::where($where)->update($updateArr);
 
        return Response::json($event);
    } 
 
 
    public function destroy(Request $request)
    {
        $event = WorkingHours::where('id',$request->id)->delete();
   
        return Response::json($event);
    }





    // public function index(){
    // 	$events = Event::get();
    // 	$event_list = [];
    // 	foreach ($events as $key => $event) {
    // 		$event_list[] = Calendar::event(
    //             $event->event_name,
    //             true,
    //             new \DateTime($event->start_date),
    //             new \DateTime($event->end_date.' +1 day')
    //         );
    // 	}
    // 	$calendar_details = Calendar::addEvents($event_list); 
 
    //     return view('events', compact('calendar_details') );
    // }
 
    // public function addEvent(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'event_name' => 'required',
    //         'start_date' => 'required',
    //         'end_date' => 'required'
    //     ]);
 
    //     if ($validator->fails()) {
    //     	\Session::flash('warnning','Please enter the valid details');
    //         return Redirect::to('/events')->withInput()->withErrors($validator);
    //     }
 
    //     $event = new Event;
    //     $event->event_name = $request['event_name'];
    //     $event->start_date = $request['start_date'];
    //     $event->end_date = $request['end_date'];
    //     $event->save();
 
    //     \Session::flash('success','Event added successfully.');
    //     return Redirect::to('/events');
    // }

 
 
}