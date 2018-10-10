<?php

namespace App\Http\Controllers;

use App\Models\usersModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function test(usersModel $usersModel){

        $t= $usersModel->find(1)->activities();
        dd($t);
    }
}
