<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Index
    public function index(){
        return view('welcome');
    }
    // Dashboard
    public function dashboard(){
        return view('dashboard');; 
    }
    //

}
