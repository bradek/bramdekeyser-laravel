<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqVragenTable extends Migration
{
    public function up()
    {
        Schema::create('faq_vragen', function (Blueprint $table) {
            $table->id();
            $table->text('vraag');
            $table->text('antwoord');
            $table->unsignedBigInteger('faq_categorie_id')->nullable()->default(null);
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('faq_vragen');
    }
}
