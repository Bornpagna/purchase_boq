<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnDeliveryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_delivery_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('return_id');
            $table->integer('warehouse_id');
            $table->string('line_no')->default('001');
            $table->integer('item_id');
            $table->string('unit');
            $table->decimal('qty',25,4)->default(0);
            $table->decimal('price',25,4)->default(0);
            $table->decimal('amount',25,4)->default(0);
            $table->decimal('refund',25,4)->default(0);
            $table->decimal('total',25,4)->default(0);
            $table->text('note');
            $table->tinyInteger('free')->default(0);
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
        Schema::dropIfExists('return_delivery_items');
    }
}
