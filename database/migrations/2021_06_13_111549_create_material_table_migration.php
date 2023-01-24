<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialTableMigration extends Migration
{
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedinteger('matAmount')->default(0);
            $table->unsignedinteger('matDefect')->default(0);
            $table->unsignedDecimal('price', 10, 2);
            $table->date('DateAdded');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('material_id')->references('id')->on('material_h_s');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
