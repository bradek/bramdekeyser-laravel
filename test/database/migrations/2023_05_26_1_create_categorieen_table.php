<?php

// Categorie migratie
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieenTable extends Migration
{
    public function up()
    {
        /*De categorieën moeten eerst aangemaakt worden, daarna pas de nieuwtjes.
        Dit is omdat nieuws de overkoepelende tabel is.
        Een tabel 'categorieen' wordt aangemaakt en bevat een id, een string 'name' en een timestamp.*/
        Schema::create('categorieen', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorieen');
    }
}