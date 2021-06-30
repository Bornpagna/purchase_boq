<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsageItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usage_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('use_id');
            $table->integer('warehouse_id');
            $table->integer('street_id');
            $table->integer('house_id');
            $table->string('line_no')->default('001');
            $table->integer('item_id');
            $table->string('unit');
            $table->float('qty')->default(0);
            $table->float('stock_qty')->default(0);
            $table->float('boq_set')->default(0);
            $table->string('note')->nullable();
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
        Schema::dropIfExists('usage_details');
    }
}
