<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function promptForPreviousSession()
    {
        return view('prompt');
    }
    public function closePreviousSession()
    {
        $ip = request()->ip();
        Session::forget('ip_sessions.' . $ip);

        return redirect()->route('welcome'); 
    }
}
