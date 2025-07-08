<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\growplan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $growplans = Growplan::all();
        return view('dashboard', compact('growplans'));
    }
}
