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
        Schema::table('collecte', function (Blueprint $table) {
            $table->unsignedBigInteger('centre_de_recyclage_id')->nullable(); // Add the foreign key column
            $table->foreign('centre_de_recyclage_id')->references('id')->on('centres_de_recyclage')->onDelete('cascade'); // Set up the foreign key constraint
        });
    }

    public function down()
    {
        Schema::table('collecte', function (Blueprint $table) {
            $table->dropForeign(['centre_de_recyclage_id']);
            $table->dropColumn('centre_de_recyclage_id');
        });
    }

};
