<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('po_id');
            $table->string('line_no')->default('001');
            $table->integer('item_id');
            $table->string('unit');
            $table->decimal('qty',25,4)->default(0);
            $table->decimal('deliv_qty',25,4)->default(0);
            $table->decimal('closed_qty',25,4)->default(0);
            $table->decimal('price',25,4)->default(0);
            $table->decimal('amount',25,4)->default(0);
            $table->decimal('disc_perc',25,4)->default(0);
            $table->decimal('disc_usd',25,4)->default(0);
            $table->decimal('total',25,4)->default(0);
            $table->text('desc');
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
        Schema::dropIfExists('order_items');
    }
}
