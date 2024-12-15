<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonnePratiquesTable extends Migration
{
    public function up()
    {
        Schema::create('bonne_pratiques', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['REDUCTION', 'REUSE', 'RECYCLE', 'COMPOSTING', 'EDUCATION']);
            $table->string('picture')->nullable(); // For the image path
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bonne_pratiques');
    }
}
