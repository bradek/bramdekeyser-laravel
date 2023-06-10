<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nieuws;

class NieuwsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*De nieuws items worden uit de database gehaald, samen met de categorieën in slechts één query.
        Het resultaat wordt volledig in de variabele $nieuwsitems gegoten.*/
        $nieuwsitems = Nieuws::with('categorie')->get();

        /*De view laatstenieuws wordt gereturnd.
        De compact('nieuwsitems') maakt een associatieve array aan.
        Deze is beschikbaar in dezelfde view.*/
        return view('laatstenieuws', compact('nieuwsitems'));
    }

    /*Hieronder bevinden zich de CRUD-methoden van de NieuwsController.
    C => Create 
    R => Read (Show in dit geval.)
    U => Update (Edit in dit geval.)
    D => Delete (Destroy in dit geval.)
    De store methode heeft als doel: het opslagen van de gegevens.*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nieuwsitem = Nieuws::findOrFail($id);
        return view('nieuwsdetail', compact('nieuwsitem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nieuwsbericht = Nieuws::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categorieen,id',
            'cover_image' => 'nullable|image|max:2048', // maximaal 2 MB
            'description' => 'nullable',
        ]);

        $nieuwsbericht->title = $request->input('title');
        $nieuwsbericht->category_id = $request->input('category_id');
        $nieuwsbericht->description = $request->input('description');

        if ($request->hasFile('cover_image')) {
            // Verwijder de oude cover-afbeelding als die bestaat
            if ($nieuwsbericht->cover_image) {
                Storage::delete($nieuwsbericht->cover_image);
            }

            // Sla de nieuwe cover-afbeelding op en update de cover_image kolom in de database
            $coverImage = $request->file('cover_image')->store('public/cover_images');
            $nieuwsbericht->cover_image = $coverImage;
        }

        $nieuwsbericht->save();

        return redirect()->route('admin.nieuwsbeheer.index')->with('success', 'Nieuwsbericht bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nieuwsitem = Nieuws::findOrFail($id);
        $nieuwsitem->delete();

        return redirect()->route('laatstenieuws')->with('success', 'Nieuwsitem verwijderd.');
    }

    
}