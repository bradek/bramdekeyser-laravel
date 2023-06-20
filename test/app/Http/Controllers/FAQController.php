<?php

namespace App\Http\Controllers;

use App\Models\FaqCategorie;
use App\Models\FaqVraag;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /*De toonFaq methode hoort de faq-view te returnen.
    Ik wil deze returnen, samen met de vragen en categorieën,
    dus ik stop dit in een variabele $categorieën.*/
    public function toonfaq()
    {
        $categorieen = FaqCategorie::with('vragen')->get();

        return view('faq', compact('categorieen'));
    }

    /*De methode faqBeheer doet eigenlijk hetzelfde met de admin.faqbeheer view zoals de toonfaq doet met de faq view.*/
    public function faqBeheer()
{
    $faqVragen = FaqVraag::with('categorieen')->get();

    return view('admin.faqbeheer.faqbeheer', compact('faqVragen'));
}

    /*Idem ditto met categorieBeheer.*/
public function categorieBeheer()
{
    $categorieen = FaqCategorie::all();

    return view('admin.categoriebeheer.categoriebeheer', compact('categorieen'));
}

/*De create view geeft de mogelijkheid nieuweFaqCategorieën toe te voegen.*/
public function create()
{
    $categorieen = FaqCategorie::all();

    return view('admin.faqbeheer.create', compact('categorieen'));
}

/*Wat gecreate wordt, moet worden gestored.
Via een request wordt de informatie gevalideerd.
Indien de validatie slaagt, wordt de create dus effectief uitgevoerd.*/
public function store(Request $request)
{
    $validatedData = $request->validate([
        'vraag' => 'required',
        'antwoord' => 'required',
        'categorieen' => 'required|array',
    ]);

    $faqVraag = FaqVraag::create([
        'vraag' => $validatedData['vraag'],
        'antwoord' => $validatedData['antwoord'],
    ]);

    $faqVraag->categorieen()->sync($validatedData['categorieen']);

    return redirect()->route('admin.faqbeheer')->with('success', 'Vraag is succesvol toegevoegd.');
}

/*Deze methode returned de edit view voor FaqVraag.*/
public function edit(FaqVraag $faqVraag)
{
    $categorieen = FaqCategorie::all();

    return view('admin.faqbeheer.edit', compact('faqVraag', 'categorieen'));
}

/*Reeds bestaande informatie kan in de methode update worden gewijzigd en opgeslagen.
De variabele $faqVraag moet synschroon lopen met de gevalideerde data van categorieën.
Wanneer het update goed is gelukt, wordt de gebruiker geredirect naar de route admin.faqbeheer.*/
public function update(Request $request, FaqVraag $faqVraag)
{
    $validatedData = $request->validate([
        'vraag' => 'required',
        'antwoord' => 'required',
        'categorieen' => 'required|array',
    ]);

    $faqVraag->update([
        'vraag' => $validatedData['vraag'],
        'antwoord' => $validatedData['antwoord'],
    ]);

    $faqVraag->categorieen()->sync($validatedData['categorieen']);

    return redirect()->route('admin.faqbeheer')->with('success', 'Vraag is succesvol bijgewerkt.');
}

/*Hier kunnen vragen worden verwijderd.*/
public function destroy(FaqVraag $faqVraag)
{
    $faqVraag->categorieen()->detach();
    $faqVraag->delete();

    return redirect()->route('admin.faqbeheer')->with('success', 'Vraag is succesvol verwijderd.');
}


/*
Hier gebeurt hetzelfde, maar dan voor de categorieën in plaats van de vragen.
*/
public function createCategorie()
{
    return view('admin.categoriebeheer.create');
}

public function editCategorie(FaqCategorie $categorie)
{
    return view('admin.categoriebeheer.edit', compact('categorie'));
}

public function destroyCategorie(FaqCategorie $categorie)
{
    $categorie->delete();

    return redirect()->route('admin.categoriebeheer')->with('success', 'Categorie is succesvol verwijderd.');
}

public function storeCategorie(Request $request)
{
    $validatedData = $request->validate([
        'naam' => 'required',
    ]);

    FaqCategorie::create([
        'faq_categorienaam' => $validatedData['naam'],
    ]);

    return redirect()->route('admin.categoriebeheer')->with('success', 'Categorie is succesvol toegevoegd.');
}

public function updateCategorie(Request $request, FaqCategorie $categorie)
{
    $validatedData = $request->validate([
        'naam' => 'required',
    ]);

    $categorie->update([
        'faq_categorienaam' => $validatedData['naam'],
    ]);

    return redirect()->route('admin.categoriebeheer')->with('success', 'Categorie is succesvol bijgewerkt.');
}
}