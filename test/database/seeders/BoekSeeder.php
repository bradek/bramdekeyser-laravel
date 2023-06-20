<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Boek;

class BoekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Verwijder bestaande gegevens
        Boek::truncate();

        // Voeg nieuwe boeken toe
        Boek::create([
            'titel' => 'Duistere Krachten - De Bedreigde Vampier',
            'prijs' => 16.45,
            'cover_afbeelding' => 'https://storage.boekscout.nl/media/1ed3ba9e-93ff-69e0-bc76-53a252468f5b.webp',
            'beschrijving' => 'Dit is het eerste uitgegeven werk van Bram Dekeyser in 2015.',
        ]);

        Boek::create([
            'titel' => 'Poëzie, de weg naar de filosofie',
            'prijs' => 16.50,
            'cover_afbeelding' => 'https://storage.boekscout.nl/media/1ed3b9ae-e8e6-6102-b822-3d40042d00e6.webp',
            'beschrijving' => 'Dit is het tweede uitgegeven werk van Bram, een gedichtenbundel! Deze werd uitgegeven in 2016.',
        ]);

        Boek::create([
            'titel' => 'Heian - De Bedreiging van Oberon',
            'prijs' => 21.50,
            'cover_afbeelding' => 'https://storage.boekscout.nl/media/1ed3b22b-b7f4-6344-b85d-43c4701a2ab1.webp',
            'beschrijving' => 'Dit is het eerste werk in de Heian-boekenreeks die een reeks van vijf boeken zal worden. Deze werd uitgegeven in 2022.',
        ]);

        Boek::create([
            'titel' => 'Heian - Een Eerlijke Strijd (Wordt verwacht in 2023)',
            'prijs' => 0.00,
            'cover_afbeelding' => 'https://cdn.pixabay.com/photo/2019/02/16/16/12/coming-soon-4000552_1280.png',
            'beschrijving' => 'Dit is het eerste werk in de Heian-boekenreeks die een reeks van vijf boeken zal worden. Deze werd uitgegeven in 2022.',
        ]);

        // Voeg meer boeken toe...

        // Aantal boeken toegevoegd
        $this->command->info('Boeken gegevens zijn toegevoegd.');
    }
}

