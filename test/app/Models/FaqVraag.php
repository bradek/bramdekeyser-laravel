<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqVraag extends Model
{
    protected $table = 'faq_vragen';
    protected $fillable = ['vraag', 'antwoord'];

    /*De methode categorieen() verwijst naar FaqCategorie. 
    FaqCategorie en FaqVraag worden gelinkt via een meer-op-meer-relatie.*/
    public function categorieen()
    {
        return $this->belongsToMany(FaqCategorie::class, 'faq_vraag_categorie', 'faq_vraag_id', 'faq_categorie_id');
    }
}
