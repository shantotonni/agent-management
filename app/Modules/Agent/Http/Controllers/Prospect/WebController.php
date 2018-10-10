<?php

namespace App\Modules\Agent\Http\Controllers\Prospect;

use App\Models\activitiesModel;
use App\Models\prospecitModel;
use App\Models\timetabelModel;
use App\Modules\Superadmin\Http\Requests\CreatestoreRequest;
use Illuminate\Http\Request;
use App\Modules\Agent\Http\Requests\CreateProspectRequest;
use App\Models\phaseModel;
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
        $pros = prospecitModel::all();

        return view('agent::Prospect.index')->with('pros',$pros);

    }



    public function create()
    {
        $phase = phaseModel::all();

        return view('agent::Prospect.create')->with('phase',$phase);
    }


    public function store(CreateProspectRequest $request)
    {

        $entry = new prospecitModel();

        $timetable =  new timetabelModel();
         $activity = new activitiesModel();


        $entry->phase_id = $request->phase;
        $entry->client_name = $request->Company_Name;
        $entry->address = $request->Adrress;
        $entry->area = $request->area;
        $entry->pc_1 = $request->Contact_num_one;
        $entry->pc_2 = $request->Contact_num_two;
        $entry->pc_3 = $request->Contact_num_three;
        $entry->remarks = $request->remark;
        $entry->demand = $request->demand;
        $entry->contact_person = $request->Contact_Person;
        $entry->created_by =Auth::id();
        $entry->updated_by = Auth::id();

        $entry->save();



        if ($request->meeting_date==null && $request->meeting_start==null && $request->meeting_end==null){
            return Redirect::back()->with('msg','successfully Added');
        }
        else{

        if($entry->id){

            $timetable->date = $request->meeting_date;
            $timetable->start_time = $request->meeting_start;
            $timetable->end_time =  $request->meeting_end;

            $timetable->created_by = Auth::id();
            $timetable->updated_by = Auth::id();
            $timetable->prospecit_id = $entry->id;
            $timetable->save();

            if($timetable->id){

                return Redirect::back()->with('msg','successfully Added');
            }else{
                return Redirect::back()->with('msg','failed to add');
            }
        }
        }

    }


    public function show($id)
    {
        $pros = prospecitModel::find($id);


        return view('agent::Prospect.show')->with('pros',$pros);
}


    public function edit($id)
    {
         $pros = prospecitModel::find($id);
        return view('agent::Prospect.edit')->with('pros',$pros);
    }



        public function update(Request $request, $id)
    {
      //  dd($request->all());

      $pros = prospecitModel::find($id);

      $pros->phase_id = $request->phase;
      $pros->address = $request->Adrress;
      $pros->pc_1 = $request->Contact_num_one;
      $pros->pc_2 = $request->Contact_num_two;
      $pros->pc_3 = $request->Contact_num_three;
      $pros->area = $request->area;
      $pros->demand = $request->demand;
      $pros->remarks = $request->remarks;
      $pros->contact_person = $request->Contact_Person;
      $pros->updated_by = Auth::id();
      $pros->update();

      if($pros->id){
           timetabelModel::where(['prospecit_id' => $id])->update(['date' => $request->mdate,'start_time'=>$request->start_time,'end_time'=>$request->end_time,'updated_by'=>Auth::id()]);

      }

        if($pros->id){

            return Redirect::back()->with('msg','successfully Updated');
        }else{

            return Redirect::back()->with('msg','Update failed');
        }



    }



    public function delete($id)
     {
             $pros = prospecitModel::find($id);
             $pros->delete();
             return Redirect::back()->with('msg','Successfully Deleted ');

     }

}
