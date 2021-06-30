<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsageFoumulaDetailsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usage_formula_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('formula_id')->default(0);
            $table->integer('house_id');
            $table->integer('item_id')->default(0);
            $table->float('percentage')->default(0)->comment("percentage as value 0 -> 100");
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
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
        Schema::dropIfExists('usage_formula_details');
    }
}
