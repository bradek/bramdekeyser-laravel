<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nieuws;

class NieuwsbeheerController extends Controller
{
    public function index()
    {
        /*Ik maak een variabele 'nieuwsberichten' aan.
        Deze maakt gebruik van de informatie uit de Nieuws-model en maakt gebruik van methode categorie().µ
        Deze methode is nodig voor de category_id waarmee de link tussen nieuws en categorieen wordt gemaakt.*/
        $nieuwsberichten = Nieuws::with('categorie')->get();

        /*Ik return de view en geef hierbij de variabelen nieuwsberichten mee.*/
        return view('admin.nieuwsbeheer.index', compact('nieuwsberichten'));
    }

    public function create()
    {
        $categorieen = Categorie::all();
        return view('admin.nieuwsbeheer.create', compact('categorieen'));
    }

    public function store(Request $request)
    {
        // Valideer en sla het nieuwe nieuwsbericht op
    }

    public function edit($id)
    {
        $nieuwsbericht = Nieuws::findOrFail($id);
        $categorieen = Categorie::all();
        return view('admin.nieuwsbeheer.edit', compact('nieuwsbericht', 'categorieen'));
    }

    public function update(Request $request, $id)
    {
        // Valideer en update het nieuwsbericht
    }

    public function destroy($id)
    {
        $nieuwsbericht = Nieuws::findOrFail($id);
        // Verwijder het nieuwsbericht
    }
}
