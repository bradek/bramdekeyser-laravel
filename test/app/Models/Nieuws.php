<?php

// Nieuws model
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Nieuws;

class Nieuws extends Model
{
    //protected $table = 'categorieen';
    /*De fillable array bevat een titel, category_id, cover_image, description en publication_date.*/
    protected $fillable = ['title', 'category_id', 'cover_image', 'description', 'publication_date'];

    /*Deze methode returned de relation.
    category_id is de id waarmee gelinkt wordt om met de categorieën te linken.
    Het is een één op veel relatie.
    Een nieuwsitem heeft een categorie, maar een categorie kan gelinkt zijn aan meerdere nieuwsitems.*/
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }
}