<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id');
            $table->string('ref_no');
            $table->string('reference');
            $table->dateTime('trans_date');
            $table->integer('eng_usage');
            $table->integer('sub_usage')->default(0);
            $table->string('desc')->nullable();
            $table->tinyInteger('policy')->default(0)->comment("0.Not set policy, 1.Set Policy");
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
        Schema::dropIfExists('usages');
    }
}
