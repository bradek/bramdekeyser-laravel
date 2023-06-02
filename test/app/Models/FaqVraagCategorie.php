<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*FaqVraagCategorie is een tabel die als tussentabel dient.
Deze is gelinkt aan FaqCategorie en FaqVraag.
Zo'n tussentabel bleek nodig te zijn omdat ik gebruik maakte van een meer-op-meer relatie.
Dit is anders dan bij nieuws, waar ik gebruik maak van een één-op-één relatie.*/
class FaqVraagCategorie extends Model
{
    protected $table = 'faq_vraag_categorie';
    protected $fillable = ['faq_vraag_id', 'faq_categorie_id'];

    // Optioneel: timestamps uitschakelen
    public $timestamps = false;
}