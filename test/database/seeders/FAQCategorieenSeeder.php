<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqCategorie;

class FAQCategorieenSeeder extends Seeder
{
    public function run()
    {
        $categorieen = [
            ['faq_categorienaam' => 'boeken'],
            ['faq_categorienaam' => 'uitgave'],
        ];

        foreach ($categorieen as $categorie) {
            FaqCategorie::create($categorie);
        }
    }
}