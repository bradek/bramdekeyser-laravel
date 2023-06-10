<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nieuws;


class NieuwsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Hier worden de default nieuwtjes aangemaakt via een seeder.*/
        Nieuws::create([
            'title' => 'Heian - De Bedreiging van Oberon',
            'category_id' => 1,
            'cover_image' => 'app/',
            'description' => 'Eerste boek in de fantasy serie van Heian.',
            'publication_date' => now(),
        ]);
    }
}