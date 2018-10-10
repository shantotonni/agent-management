<?php

namespace App\Modules\Superadmin\Http\Controllers\Dashboard;

use App\Models\activitiesModel;
use App\Models\phaseModel;
use App\Models\prospecitModel;
use App\Models\timetabelModel;
use App\User;
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


    public function dashboard()
    {
        if (Auth::user()->type==1){
            $superadmin=prospecitModel::all();
            //dd($superadmin);
            $phase=prospecitModel::where('phase_id','=',1)->get();
            $time=timetabelModel::where('created_by',Auth::user()->id)->get();
            $complit=activitiesModel::where('created_by',Auth::user()->id)->get();
            //$total=$time+$complit;\

            $t=count($time);
            $a=count($complit);
            $total=$t+$a;

            $user=User::all();
            return view('superadmin::Dashboard.dashboard',compact('superadmin','complit','time','total','phase','user','total'));
    }
    else{

        $superadmin=prospecitModel::where('created_by',Auth::user()->id)->get();

        //dd($superadmin);
        $phase=prospecitModel::where('phase_id','=',1)->get();
        $time=timetabelModel::where('created_by',Auth::user()->id)->get();
        $complit=activitiesModel::where('created_by',Auth::user()->id)->get();
        //$total=$time+$complit;\

        $t=count($time);
        $a=count($complit);
        $total=$t+$a;

        $user=User::all();
        return view('superadmin::Dashboard.dashboard',compact('superadmin','complit','time','total','phase','user','total'));
    }
    }




    public function agentsearch(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'from_date' => 'required|max:255',
            'to_date' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::route('dashboard')->withErrors($validator);
        }


        $start = date("Y-m-d",strtotime($request->input('from_date')));
        $end = date("Y-m-d",strtotime($request->input('to_date')));

        $time = timetabelModel::whereBetween('date', [$start, $end])->get();

        $superadmin = prospecitModel::whereBetween('created_at', [$start, $end])->get();
        $complit = activitiesModel::whereBetween('created_at', [$start, $end])->get();
        $phase=prospecitModel::where('phase_id','=',1)->get();
        $user=User::all();

        return view('superadmin::Dashboard.dashboard',compact('prospecit','superadmin','complit','activity','time','total','phase','user'));

    }


    public function superAdminSearch(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'from_date' => 'required|max:255',
            'to_date' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::route('dashboard')->withErrors($validator);
        }


        if ($request->user_id=='all'){

            $start = date("Y-m-d",strtotime($request->input('from_date')));
            $end = date("Y-m-d",strtotime($request->input('to_date')));

            $time = timetabelModel::whereBetween('date', [$start, $end])->get();

            $superadmin = prospecitModel::whereBetween('created_at', [$start, $end])->get();
            $complit = activitiesModel::whereBetween('created_at', [$start, $end])->get();
            $phase=prospecitModel::where('phase_id','=',1)->get();
            $user=User::all();

            $t=count($time);
            $a=count($complit);
            $total=$t+$a;

            return view('superadmin::Dashboard.dashboard',compact('prospecit','superadmin','complit','activity','time','total','phase','user'));
        }
        else {

        $user=$request->user_id;

        $start = date("Y-m-d",strtotime($request->input('from_date')));
        $end = date("Y-m-d",strtotime($request->input('to_date')));

        $time = timetabelModel::whereBetween('date', [$start, $end])->where('created_by',$user)->get();

        $superadmin = prospecitModel::whereBetween('created_at', [$start, $end])->where('created_by',$user)->get();

       // dd($superadmin);
        $complit = activitiesModel::whereBetween('created_at', [$start, $end])->where('created_by',$user)->get();
        $phase=prospecitModel::where('phase_id','=',1)->get();
        $user=User::all();

        $t=count($time);
        $a=count($complit);
        $total=$t+$a;

        return view('superadmin::Dashboard.dashboard',compact('prospecit','superadmin','complit','activity','time','total','phase','user'));


        }
    }


    public function getlogout(){
        Auth::logout();
        return redirect('/login');
    }
}
