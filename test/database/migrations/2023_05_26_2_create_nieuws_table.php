<?php

// Nieuws migratie
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNieuwsTable extends Migration
{
        /*De categorieën moeten eerst aangemaakt worden, daarna pas de nieuwtjes.
        Dit is omdat nieuws de overkoepelende tabel is.
        Een tabel 'nieuws' wordt aangemaakt en bevat een id, een titel, cover_image, description, publication_date
        en een timestamps.*/
    public function up()
    {
        Schema::create('nieuws', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cover_image');
            $table->text('description');
            $table->date('publication_date');
            $table->timestamps();

            /*category_id is de foreigner key.
            Deze sleutel maakt deel uit van de tabel 'categorieen'.*/
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categorieen');
        });
    }

    public function down()
    {
        Schema::dropIfExists('nieuws');
    }
};