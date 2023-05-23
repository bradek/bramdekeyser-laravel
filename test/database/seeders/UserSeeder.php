<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        /*Dit zijn de gebruikersgegevens van de admin.
        Deze admin heeft nog geen rechten, deze moet ik nog toevoegen.
        Het doel is dat de seeder al zou werken.*/
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@ehb.be',
                'password' => Hash::make('Password!321'),
                'admin' => true,
            ],
            /*Hierachter kan ik meer gebruikers aanmaken als ik dat wil.*/
        ];

        /*Met deze foreach ga ik doorheen de lijst van users.
        Deze voeg ik dan één voor één toe aan de database tabel 'users'.*/
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}