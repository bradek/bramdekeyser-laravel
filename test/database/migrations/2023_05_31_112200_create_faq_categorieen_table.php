<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqCategorieenTable extends Migration
{
    public function up()
    {
        Schema::create('faq_categorieen', function (Blueprint $table) {
            $table->id();
            $table->string('faq_categorienaam');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('faq_categorieen');
    }
}
