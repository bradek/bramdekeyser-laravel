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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}