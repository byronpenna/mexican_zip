<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipFederalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zip_federals', function (Blueprint $table) {
            $table->id();
            $table->integer("zip_id")->unsigned();
            $table->integer("federal_id")->unsigned();

            $table->foreign("zip_id")->
                references("id")->
                on("zips");
            $table->foreign("federal_id")->
                references("id")->
                on("federals");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zip_federals');
    }
}
