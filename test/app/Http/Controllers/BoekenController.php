<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boek;

class BoekenController extends Controller
{
    /*Alle boeken worden in de variabele $boeken gegoten.
    De view wordt gereturned, samen met de boeken.*/
    public function index(){
        $boeken = Boek::all();
        return view('boeken.index', compact('boeken'));
    }
}