<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoekenController extends Controller
{
    public function index(){
        return view('boeken/index');
    }
}
