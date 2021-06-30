<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id');
            $table->integer('ref_id');
            $table->string('ref_no');
            $table->string('ref_type')->comment("stock entry, stock import, stock move, return usage, stock adjust, usage items, return usage, stock delivery, return delivery");
            $table->string('line_no')->default('001');
            $table->integer('item_id');
            $table->string('unit');
            $table->float('qty')->default(0);
            $table->decimal('cost',25,4)->default(0);
            $table->decimal('amount',25,4)->default(0);
            $table->integer('warehouse_id');
            $table->dateTime('trans_date');
            $table->char('trans_ref',1)->default('I')->comment('I=in, O=out');
            $table->string('alloc_ref')->nullable()->comment('0001001');
            $table->string('reference')->nullable();
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
        Schema::dropIfExists('stocks');
    }
}
