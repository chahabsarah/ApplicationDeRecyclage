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
        Schema::table('flux_de_donnees', function (Blueprint $table) {
            $table->unsignedBigInteger('collecte_id')->nullable()->after('id');

            $table->foreign('collecte_id')->references('id')->on('collectes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('flux_de_donnees', function (Blueprint $table) {
            $table->dropForeign(['collecte_id']);
            $table->dropColumn('collecte_id');
        });
    }
};
