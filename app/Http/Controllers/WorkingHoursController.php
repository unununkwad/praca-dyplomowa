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
            $id = Auth::id();
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
    
            $data = WorkingHours::whereDate('start', '>=', $start)
                                ->whereDate('end',   '<=', $end)
                                ->where('user_id', '=', $id)
                                ->get(['id', 'start', 'end', 'user_id']);
            return Response::json($data);
        }
        return view('working-hours');
    }
    
   
    public function create(Request $request)
    {
        $id = Auth::id();
        $insertArr = [ 'start' => $request->start,
                       'end' => $request->end,
                       'user_id' => $id
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
}