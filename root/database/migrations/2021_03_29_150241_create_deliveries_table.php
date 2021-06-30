<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id');
            $table->integer('po_id');
            $table->integer('sup_id');
            $table->string('ref_no')->unique();
            $table->dateTime('trans_date');
            $table->decimal('shipping',25,4)->default(0);
            $table->decimal('sub_total',25,4)->default(0);
            $table->decimal('tax',25,4)->default(0);
            $table->decimal('discount',25,4)->default(0);
            $table->decimal('disc_perc',25,4)->default(0);
            $table->decimal('disc_usd',25,4)->default(0);
            $table->decimal('grand_total',25,4)->default(0);
            $table->text('note');
            $table->text('photo');
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
        Schema::dropIfExists('deliveries');
    }
}
