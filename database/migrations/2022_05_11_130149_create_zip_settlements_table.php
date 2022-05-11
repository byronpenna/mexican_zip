<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zip_settlements', function (Blueprint $table) {
            $table->id();
            $table->integer("zip_id")->unsigned();
            $table->integer("settlements_id")->unsigned();

            $table->foreign("zip_id")->
                references("id")->
                on("zips");

            $table->foreign("settlements_id")->
            references("id")->
            on("settlements");

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
        Schema::dropIfExists('zip_settlements');
    }
}
