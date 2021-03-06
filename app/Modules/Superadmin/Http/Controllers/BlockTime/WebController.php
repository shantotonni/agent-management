<?php

namespace App\Modules\Superadmin\Http\Controllers\BlockTime;

use App\Models\prospecitModel;
use App\Models\timetabelModel;
use App\Models\usersModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $times=timetabelModel::all();
        return view('superadmin::BlockTime.index',compact('times'));
    }


    public function create()
    {
//        $user=usersModel::all();
        $prospecit=prospecitModel::all();
        return view('superadmin::BlockTime.create',compact('prospecit'));
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',

        ]);
        if ($validator->fails()) {
            return Redirect::route('block_time_create')->withErrors($validator);
        }
        $user=Auth::id();
//        $prospecit=prospecitModel::id;

        $time=new timetabelModel();

        $time->date=$request->date;
        $time->start_time=$request->start_time;
        $time->end_time=$request->end_time;
        $time->created_by=$user;
        $time->updated_by=$user;
        //$time->prospecit_id=$request->prospecit_id;

        $time->save();

        return Redirect::route('block_time_create')->with('msg','data inserted');

    }


    public function show($id)
    {
        $time=timetabelModel::find($id);
        return view('superadmin::BlockTime.show',compact('time'));
    }


    public function edit($id)
    {
        $time=timetabelModel::find($id);
        return view('superadmin::BlockTime.edit',compact('time'));
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',

        ]);
        if ($validator->fails()) {
            return Redirect::route('block_time_edit',$id)->with('msg','data not updated');
        }

        $user=Auth::id();
//        $prospecit=prospecitModel::id;

        $time=timetabelModel::find($id);

        $time->date=$request->date;
        $time->start_time=$request->start_time;
        $time->end_time=$request->end_time;
        $time->created_by=$user;
        $time->updated_by=$user;
        //$time->prospecit_id=$request->prospecit_id;

        $time->save();

        return Redirect::route('block_time')->with('msg','data updated');

    }


    public function delete($id)
    {
        $user=timetabelModel::find($id);
        $user->delete();
        return Redirect::route('block_time')->with('msg','data Deleted');
    }

    public function checktime(Request $request){

        if(!$request->ajax()){
            return "Only adminstrator Access";
        }
        $ava= timetabelModel::Mdate($request->date)->Endtime($request->end)->Starttime($request->start)->get()->count();
      // $sql = "SELECT * FROM `timetable` WHERE date='$request->date' AND timetable.end_time>= '$request->start' AND timetable.start_time<='$request->end'";
      return $ava;
    }
}
