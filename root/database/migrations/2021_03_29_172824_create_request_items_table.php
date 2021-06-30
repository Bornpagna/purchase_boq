<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('line_no')->default('001');
            $table->integer('pr_id');
            $table->integer('item_id');
            $table->string('unit');
            $table->decimal('qty',25,4)->default(0);
            $table->decimal('boq_set',25,4)->default(0);
            $table->decimal('ordered_qty',25,4)->default(0);
            $table->decimal('closed_qty',25,4)->default(0);
            $table->decimal('price',25,4)->default(0);
            $table->string('desc')->nullable();
            $table->string('remark')->nullable();
            $table->string('size')->nullable();
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
        Schema::dropIfExists('request_items');
    }
}
