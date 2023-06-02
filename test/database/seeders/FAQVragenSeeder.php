<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqVraag;
use App\Models\FaqVraagCategorie;

class FAQVragenSeeder extends Seeder
{
    public function run()
    {
        $vraag = 'Hoeveel pagina\'s heeft een boek?';
        $antwoord = 'Dat hangt af van het woordenaantal, paginagrootte en de marges.';
        $categorieen = [1, 2]; // Categorie IDs

        $faqVraag = FaqVraag::create([
            'vraag' => $vraag,
            'antwoord' => $antwoord,
        ]);

        foreach ($categorieen as $categorieId) {
            FaqVraagCategorie::create([
                'faq_vraag_id' => $faqVraag->id,
                'faq_categorie_id' => $categorieId,
            ]);
        }
    }
}
