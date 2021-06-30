<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockMoveItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_move_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('move_id');
            $table->integer('from_warehouse_id');
            $table->integer('to_warehouse_id');
            $table->string('line_no')->default('001');
            $table->integer('item_id');
            $table->string('unit');
            $table->float('qty')->default(0);
            $table->float('stock_qty')->default(0);
            $table->text('note');
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
        Schema::dropIfExists('stock_move_details');
    }
}
