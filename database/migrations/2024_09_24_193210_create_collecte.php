<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('collecte', function (Blueprint $table) {

            $table->id();
            $table->string('nom');
            $table->string('etat');
            $table->string('type_dechet');
            $table->json('output')->nullable();
            $table->string('image');
            $table->float('poids_contenu');
            $table->string('output_description')->nullable();
            $table->unsignedBigInteger('centre_de_recyclage_id');
            $table->foreign('centre_de_recyclage_id')
            ->references('id')->on('centres_de_recyclage');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('collecte');
    }
};
