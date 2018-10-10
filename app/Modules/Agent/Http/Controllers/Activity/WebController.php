<?php

namespace App\Modules\Agent\Http\Controllers\Activity;

use Illuminate\Http\Request;
use App\Models\activitiesModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WebController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {
        return view('agent::Activity.index');
    }

    public function create()
    {
        return view('agent::Activity.create');
    }


    public function store(Request $request)
    {

      $activities = new activitiesModel();

        $activities->date = $request->date;
        $activities->start_time = $request->start_time;
        $activities->end_time = $request->end_time;
        $activities->prospecit_id = $request->pros_id;
        $activities->remarks = $request->remarks;
        $activities->created_by = Auth::id();
        $activities->updated_by = Auth::id();

        $activities->save();

        if ($activities->id) {

            return Redirect::back()->with('msg', 'successfully Updated');
        } else {

            return Redirect::back()->with('msg', 'Update failed');
        }


    }


    public function edit($id)
    {
        $activity=activitiesModel::find($id);

        return view('agent::Activity.edit',compact('activity'));
    }


    public function update(Request $request, $id)
    {
        $activity=activitiesModel::find($id);

        $activity->remarks=$request->remarks;
        $activity->save();

        return Redirect::route('remarks.edit',$id)->with('msg','Activity updated succesfully');
    }


    public function delete($id)
    {
        $activity=activitiesModel::find($id);
        $activity->delete();

        return Redirect::back()->with('del','Activity Deleted succesfully');

    }
}
