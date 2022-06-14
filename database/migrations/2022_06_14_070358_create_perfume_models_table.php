<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfumeModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfume_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('id_brand');
            $table->unsignedBigInteger('id_scent');
            $table->string('concentration');
            $table->string('image')->nullable();
            $table->string('description');
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
        Schema::dropIfExists('perfume_models');
    }
}
