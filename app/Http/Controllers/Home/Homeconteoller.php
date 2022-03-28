<?php

namespace App\Http\Controllers\Home;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Homeconteoller extends Controller
{
    public function index()
    {
        if (Auth::user() &&  Auth::user()->hasRole('student')) {
            return redirect()->route('student.index');
        }
        elseif(Auth::user() &&  Auth::user()->hasRole('Administrator')){
            return redirect()->route('administrator.index');
        }
        return redirect()->back();
        
    }

    public function verify()
    {
        
        return Inertia::render('Home/Verify');
    }
}
