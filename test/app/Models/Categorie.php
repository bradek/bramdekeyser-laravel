<?php

// Categorie model
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /*In dit geval moet ik de naam van het meervoud erbij geven.
    Ik kreeg voorheen een probleem omdat Laravel 'categorie' automatisch in het meervoud 'categories' noemde.
    Hierdoor kreeg ik problemen met mijn migrations, omdat ik gebruik maak van 'categorieen' in mijn databank.*/
    protected $table = 'categorieen';

    /*Door een fillable array te maken, kan ik later de methode fill() gebruiken.*/
    protected $fillable = ['name'];

    /*Deze methode returned de relation.
    category_id is de id waarmee gelinkt wordt om met de categorieën te linken.
    Het is een één op veel relatie.
    Een nieuwsitem heeft een categorie, maar een categorie kan gelinkt zijn aan meerdere nieuwsitems.*/
    public function nieuws()
    {
        return $this->hasMany(Nieuws::class, 'category_id');
    }
}