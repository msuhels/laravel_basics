<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helpers;
use Illuminate\Routing\UrlGenerator;
use Response;
use Headers;
use DB;
use File;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {   
        // Helpers::pp("pradeep");
        return view('pages.dashboard');
    }


}
