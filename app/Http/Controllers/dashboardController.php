<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    function dashboardPage()
    {
        return view('pages.dashboard.dashboard-page');
    }
    function userProfilePage()
    {
        return view('pages.dashboard.profile-page');
    }
}