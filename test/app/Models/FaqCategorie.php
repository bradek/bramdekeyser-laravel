<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategorie extends Model
{
    /*Ik geef de table een duidelijke naam 'faq_categorieen'.
    Laravel maakt als meervoud van 'faq_categorie' blijkbaar automatisch 'faq_categories'.
    Ik maak echter gebruik van 'faq_categorieen, dus was een duidelijke benaming vereist.*/
    protected $table = 'faq_categorieen';
    protected $fillable = ['faq_categorie_id', 'faq_categorienaam'];

    /*De methode vragen() verwijst naar FaqVraag. 
    FaqCategorie en FaqVraag worden gelinkt via een meer-op-meer-relatie.*/
    public function vragen()
    {
        return $this->belongsToMany(FaqVraag::class, 'faq_vraag_categorie', 'faq_categorie_id', 'faq_vraag_id');

    }
}