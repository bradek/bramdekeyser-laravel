<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gastenboek;

class GastenboekController extends Controller
{
    /*De berichten worden opgehaald en in een methode $messages gegoten.
    Het laatste bericht komt steeds bovenaan te staan.
    Deze worden samen met de gastenboek-view gereturned.*/
    public function index()
    {
        $messages = Gastenboek::latest()->get();
        return view('gastenboek.index', compact('messages'));
    }

    /*De gebruiker hoeft niet ingelogd te zijn voor het schrijven van een bericht.
    Het is verplicht op zowel de naam in te vullen als een bericht te schrijven alvorens deze kan worden verzonden.*/
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'message' => 'required',
        ]);

        /*De informatie wordt aangemaakt.*/
        Gastenboek::create($data);

        return redirect()->route('gastenboek.index');
    }
}
