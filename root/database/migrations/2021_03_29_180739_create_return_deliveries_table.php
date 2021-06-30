<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id');
            $table->integer('dep_id');
            $table->integer('sup_id');
            $table->string('ref_no');
            $table->dateTime('trans_date');
            $table->decimal('sub_total',25,4)->default(0);
            $table->decimal('refund',25,4)->default(0);
            $table->decimal('grand_total',25,4)->default(0);
            $table->string('desc')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('return_deliveries');
    }
}
