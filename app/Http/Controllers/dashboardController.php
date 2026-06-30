<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function wargaDashboard()
    {
        return view('warga.dashboard');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
    
    public function lurahDashboard()
    {
        return view('lurah.dashboard'); 
    }

    public function rtDashboard()
    {
        return view('rt.dashboard');
    }

    public function rwDashboard()
    {
        return view('rw.dashboard');
    }
}
