<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gastenboek extends Model
{
    protected $table = 'gastenboek';
    protected $fillable = ['name', 'message'];
}
