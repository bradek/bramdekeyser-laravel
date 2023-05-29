<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Ik heb 'admin' pas later aan mijn database tabel users toegevoegd.
        Omwille van die reden is hier ook een aparte migration voor.
        Admin is een boolean die als standaard waarde 'false' heeft.*/
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('admin')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};