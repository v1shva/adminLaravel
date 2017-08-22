<?php

namespace App\Http;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Exceptions\UnauthorizedException;

class AppDbController extends Controller
{


    public function index()
    {
        $profiles = Profile::paginate(10);
        return view('profile.index', compact('profiles'));

    }


    public function show(Request $request)
    {
        
    }
}

