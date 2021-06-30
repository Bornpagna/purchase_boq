<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsageFormulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usage_formulas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('zone_id')->default(0);
            $table->integer('block_id')->default(0);
            $table->integer('street_id')->default(0);
            $table->tinyInteger('status')->default(1)->comment('1=active,0=trash');
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
        Schema::dropIfExists('usage_formulas');
    }
}
