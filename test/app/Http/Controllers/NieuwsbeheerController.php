<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nieuws;
use Illuminate\Support\Facades\Storage;
use App\Models\Categorie;

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

    /*De create-methode returnd de admin.nieuwsbeheer.create view, samen met categorieen,
    die gebruik maakt van de model Categorie.
    Ik maak een variabele $categorieen aan die van alle informatie van Categorie gebruik maakt.*/
    public function create()
    {
        $categorieen = Categorie::all();
        return view('admin.nieuwsbeheer.create', compact('categorieen'));
    }

    public function store(Request $request)
    {
        /*De data wordt gevalideerd.
        Elk van deze onderdelen zijn required.*/
        $validatedData = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'cover_image' => 'nullable|image|max:2048',
            'description' => 'required',
            'publication_date' => 'date'
        ]);

            /*Met deze dd wil ik nagaan of alle nodige data correct wordt weergegeven.
            Op het moment van het gebruiken van deze store methode, had ik in de create namelijk wat problemen.
            dd($request->all();*/

            /*Ik probeerde hierbij verder te testen door een dd via de log te gebruiken.*/
        
        /*Ik maak hier een nieuw nieuwsartikel aan via een create.
        De publication_date is de huidige datum.
        Vandaar de ?? now().*/
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image')->store('public/cover_images');
        }

        $nieuwsartikel = Nieuws::create([
            'title' => $validatedData['title'],
            'category_id' => $validatedData['category_id'],
            'description' => $validatedData['description'],
            'publication_date' => $validatedData['publication_date'] ?? now(),
            'cover_image' => '/storage/'. $coverImage
        ]);

    
        $nieuwsartikel->save();

        /*Als het storen is geslaagd, wordt de admin geredirect naar de hoofdpagina van het nieuwsbeheergedeelte.*/
        return redirect()->route('admin.nieuwsbeheer.index');
    }

    /*Ik maak gebruik van de model Nieuws, en deze zet ik in een variabele $nieuwsbericht zodat ik deze aan kan roepen.
    Ik maak gebruik van $id zodat ik kan loopen doorheen de nieuwsberichten.
    Ik maak dan gebruik van de model Categorie en zet al deze informatie in de variabele $categorieen.
    Ik return de view admin.nieuwsbeheer.edit en maak gebruik van nieuwsbericht en categorieen.*/
    public function edit($id)
    {
        $nieuwsbericht = Nieuws::findOrFail($id);
        $categorieen = Categorie::all();
        return view('admin.nieuwsbeheer.edit', compact('nieuwsbericht', 'categorieen'));
    }

    public function update(Request $request, $id)
    {
        /*Een variabele wordt aangemaakt die gebruik maakt van de Nieuws-model.
        Via findOrFail($id) wordt er via een opgegeven id een nieuwsbericht gebruikt.
        Als het nieuwsbericht niet wordt gevonden zal er een 'ModelNotFoundException' worden gegenereerd.*/
        $nieuwsbericht = Nieuws::findOrFail($id);

        /*Ik valideer de gegeven informatie.*/
        $validatedData = $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categorieen,id',
            'cover_image' => 'image|max:2048',
            'description' => 'nullable',
            'publication_date' => 'date'
        ]);

        /*Ik update het nieuwsbericht op basis van de nieuwe gevalideerde data.*/
        $nieuwsbericht->update($validatedData);

        /*De eerste if-statement gaat na of er al een cover image is geupload.
        Bij de tweede if-statement wordt er nagegaan of het nieuwsbericht al eerder een cover image aangewezen heeft gekregen.
        Als dit het geval is, wordt de oude uit de Storage verwijderd, zodat de nieuwe kan worden opgeslaan.*/
        if ($request->hasFile('cover_image')) {
            if ($nieuwsbericht->cover_image) {
                Storage::delete($nieuwsbericht->cover_image);
            }

            /*Via een request wordt de file (in dit geval de afbeelding cover_image) opgeslagen in de folder public/cover_images.*/
            $coverImage = $request->file('cover_image')->store('public/cover_images');
            
            /*Het tabel-item cover_image bij dit specifieke nieuwsbericht, krijgt nu de nieuwe cover_image toegewezen.*/
            $nieuwsbericht->cover_image = $coverImage;

            /*De informatie van het nieuwsbericht wordt opgeslaan.*/
            $nieuwsbericht->save();
        }

        /*Als het updaten wordt gelukt, wordt de gebruiker teruggebracht naar de index-pagina van het admin-gedeelte.
        Er is een succes-bericht voorgemaakt die ik later kan oproepen in die index-pagina als ik dat zou willen.*/
        return redirect()->route('admin.nieuwsbeheer.index')->with('success', 'Nieuwsbericht bijgewerkt.');
    }

    public function destroy($id)
    {
        /*Er wordt gezocht naar een specifieke nieuwsbericht op basis van een opgevraagde ID.
        Deze wordt in de variabele $nieuwsbericht gestockeerd.
        Dit nieuwsbericht wordt vervolgens verwijderd via de delete()-methode.*/
        $nieuwsbericht = Nieuws::findOrFail($id);
        $nieuwsbericht->delete();
    
        /*De gebruiker wordt na een geslaagde verwijdering terug geredirect naar de index-pagina van het admin-gedeelte.*/
        return redirect()->route('admin.nieuwsbeheer.index');
    }
}
