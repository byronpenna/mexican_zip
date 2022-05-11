<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFederalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federals', function (Blueprint $table) {
            $table->increments("id");

            $table->string("name");
            $table->string("code")->nullable();

            //$table->unsignedBigInteger("zip_id");
            //$table->foreign("zip_id")->references("id")->on("zips");
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
        Schema::dropIfExists('federals');
    }
}
