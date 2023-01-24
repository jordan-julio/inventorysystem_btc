<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsedMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('used_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('material_u_id');
            $table->unsignedBigInteger('mat_id');
            $table->integer('qty');
            $table->timestamps();
            $table->foreign('material_u_id')->references('id')->on('material_u_s')->onDelete('cascade');
            $table->foreign('mat_id')->references('id')->on('material_h_s');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('used_material');
    }
}
