<?php

namespace App\Modules\Superadmin\Http\Controllers\Phase;


use App\Models\phaseModel;
use Illuminate\Http\Request;
use App\Modules\Superadmin\Http\Requests\CreatestoreRequest;
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
        $phase = phaseModel::all();

        return view('superadmin::Phase.index')->with('phase',$phase);
    }


    public function create()
    {
        return view('superadmin::Phase.create');
    }


    public function store(CreatestoreRequest $request)
    {
        $phase = new phaseModel();

        $phase->title = $request->title;
        $phase->summary = $request->summary;
        $phase->created_by = Auth::id();
        $phase->updated_by = Auth::id();

        $phase->save();

        if($phase->id){

            return Redirect::back()->with('msg','successfully store');
        }else{

            return Redirect::back()->with('msg','store failed');
        }

    }

    public function show($id)
    {
       $phase = phaseModel::find($id);

        return view('superadmin::Phase.show')->with('phase',$phase);

    }


    public function edit($id)
    {
        $phase = phaseModel::find($id);
        return view('superadmin::Phase.edit')->with('phase',$phase);
    }


    public function update(CreatestoreRequest $request,$id)
    {
       $phase = phaseModel::find($id);

        $phase->title = $request->title;
        $phase->summary = $request->summary;
        $phase->update();

        if($phase->id){

            return Redirect::back()->with('msg','successfully Updated');
        }else{

            return Redirect::back()->with('msg','Update failed');
        }
    }


    public function delete($id)
    {
       $phase = phaseModel::find($id);
        $phase->delete();

        return Redirect::back()->with('message','Successfully Deleted ');

    }
}
