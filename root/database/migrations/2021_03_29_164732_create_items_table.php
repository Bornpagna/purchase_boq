<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('desc');
            $table->integer('alert_qty')->default(0);
            $table->string('unit_stock');
            $table->string('unit_usage');
            $table->string('unit_purch');
            $table->decimal('cost_purch',25,4)->default(0);
            $table->text('photo');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('items');
    }
}
