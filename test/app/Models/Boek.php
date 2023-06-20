<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boek extends Model
{
    protected $table = 'boeken';
    protected $fillable = ['titel', 'prijs', 'cover_afbeelding', 'beschrijving'];
}