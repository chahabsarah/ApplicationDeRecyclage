<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentairesTable extends Migration
{
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bonne_pratique_id')->constrained()->onDelete('cascade'); // Relation avec la table BonnePratique
            $table->string('nom');
            $table->string('photo')->nullable(); // Champ pour l'image, peut être nul
            $table->text('description');
            $table->timestamps(); // Pour created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
}
