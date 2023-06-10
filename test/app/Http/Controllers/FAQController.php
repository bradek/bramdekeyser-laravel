<?php

namespace App\Http\Controllers;

use App\Models\FaqCategorie;
use App\Models\FaqVraag;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function toonfaq()
    {
        $categorieen = FaqCategorie::with('vragen')->get();

        return view('faq', compact('categorieen'));
    }

    public function faqBeheer()
{
    $faqVragen = FaqVraag::with('categorieen')->get();

    return view('admin.faqbeheer.faqbeheer', compact('faqVragen'));
}

public function categorieBeheer()
{
    $categorieen = FaqCategorie::all();

    return view('admin.categoriebeheer.categoriebeheer', compact('categorieen'));
}

public function create()
{
    $categorieen = FaqCategorie::all();

    return view('admin.faqbeheer.create', compact('categorieen'));
}

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

public function edit(FaqVraag $faqVraag)
{
    $categorieen = FaqCategorie::all();

    return view('admin.faqbeheer.edit', compact('faqVraag', 'categorieen'));
}

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

public function destroy(FaqVraag $faqVraag)
{
    $faqVraag->categorieen()->detach();
    $faqVraag->delete();

    return redirect()->route('admin.faqbeheer')->with('success', 'Vraag is succesvol verwijderd.');
}

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