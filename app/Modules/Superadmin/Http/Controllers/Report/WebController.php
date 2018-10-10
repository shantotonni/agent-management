<?php

namespace App\Modules\Superadmin\Http\Controllers\Report;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

}
