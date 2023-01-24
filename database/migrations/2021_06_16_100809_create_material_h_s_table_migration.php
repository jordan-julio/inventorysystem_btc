<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialHSTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_h_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('material');
            $table->unsignedinteger('TotalmatAmount')->default(0);
            $table->unsignedinteger('TotalmatDefect')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_h_s');
    }
}
