<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockImportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_imports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id');
            $table->string('ref_no');
            $table->dateTime('trans_date');
            $table->string('file_type');
            $table->string('file_name');
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
        Schema::dropIfExists('stock_imports');
    }
}
