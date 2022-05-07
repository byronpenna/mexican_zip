<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("zone_type");
            $table->unsignedBigInteger("settlement_type");

            $table->unsignedBigInteger("zip_id");
            $table->foreign("zip_id")->references("id")->on("zips");
            $table->foreign("settlement_type")->references("id")->on("settlements");
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
        Schema::dropIfExists('settlements');
    }
}
