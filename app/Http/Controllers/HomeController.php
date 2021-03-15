<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$departaments = Department::all();
    	return view('home',compact(['departaments']));
    }
}
