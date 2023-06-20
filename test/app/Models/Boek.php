<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boek extends Model
{
    /*De tabel noemt 'boeken'. 
    Als ik deze protected table niet toevoeg, zoekt de seeder naar een 'Boeks' model en die bestaat niet.*/
    protected $table = 'boeken';
    protected $fillable = ['titel', 'prijs', 'cover_afbeelding', 'beschrijving'];
}