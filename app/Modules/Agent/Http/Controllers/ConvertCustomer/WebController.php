<?php

namespace App\Modules\Agent\Http\Controllers\ConvertCustomer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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



}