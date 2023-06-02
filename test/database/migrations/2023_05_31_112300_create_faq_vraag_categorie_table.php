<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqVraagCategorieTable extends Migration
{
    public function up()
    {
        Schema::create('faq_vraag_categorie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faq_vraag_id');
            $table->unsignedBigInteger('faq_categorie_id');
            $table->timestamps();
    
            $table->foreign('faq_vraag_id')->references('id')->on('faq_vragen')->onDelete('cascade');
            $table->foreign('faq_categorie_id')->references('id')->on('faq_categorieen')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('faq_vraag_categorie');
    }
}