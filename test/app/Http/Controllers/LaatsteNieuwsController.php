<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaatsteNieuwsController extends Controller
{
    public function toonLaatsteNieuws(){
        return view('laatstenieuws');
    }
}
