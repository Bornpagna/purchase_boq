<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_usages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id');
            $table->string('ref_no');
            $table->string('reference');
            $table->dateTime('trans_date');
            $table->integer('eng_return');
            $table->integer('sub_return')->default(0);
            $table->string('desc')->nullable();
            $table->tinyInteger('delete')->default(0);
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
        Schema::dropIfExists('return_usages');
    }
}
