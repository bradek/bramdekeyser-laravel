<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaatsteNieuwsController extends Controller
{
    /*De methode toonLaatsteNieuws returned de laatstenieuws view.*/
    public function toonLaatsteNieuws(){
        return view('laatstenieuws');
    }
}