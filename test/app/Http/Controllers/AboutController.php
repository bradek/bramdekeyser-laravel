<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AboutController;

/*Ik heb via de terminal een controller gemaakt met de naam 'aboutController'.
In de index()-function return ik de about view en de index.
Deze controller kan later in de routes worden aangeroepen.*/
class AboutController extends Controller
{
    public function index(){
        return view('about');
    }
}