<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $designationsCount = \App\Models\Designation::count();
        $usersCount = \App\Models\User::count();
        $activeUsersCount = \App\Models\User::where('status', 1)->count();
        $inactiveUsersCount = \App\Models\User::where('status', 0)->count();
        return view('dashboard', compact('designationsCount', 'usersCount', 'activeUsersCount', 'inactiveUsersCount'));
    }
}