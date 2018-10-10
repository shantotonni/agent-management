<?php

namespace App\Modules\Superadmin\Http\Controllers\MeetingView;

use App\Models\prospecitModel;
use App\Models\timetabelModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{

    private $prospecit = null;

    public function __construct()
    {
        $this->prospecit=prospecitModel::all();
        $this->middleware('auth');
    }

    public function index()
    {

        $time2=timetabelModel::orderBy('date', 'asc')->orderBy('start_time', 'asc')->get();

        return view('superadmin::MeetingView.index',compact('times','time2'));


    }


    public function details($id)
    {
        $pros=timetabelModel::find($id);
         return view('superadmin::MeetingView.show',compact('pros'));
    }



    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_date' => 'required|max:255',
            'to_date' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::route('meeting')->withErrors($validator);
        }

        $start = date("Y-m-d",strtotime($request->input('from_date')));
        $end = date("Y-m-d",strtotime($request->input('to_date')));

        $time2 = timetabelModel::whereBetween('date', [$start, $end])->orderBy('date','asc')->get();

        return view('superadmin::MeetingView.index',compact('time2'));

    }


}
