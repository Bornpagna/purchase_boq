<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormatInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('format_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('format_code')->unique();
            $table->string('format_name');
            $table->integer('length');
            $table->string('prefix');
            $table->string('subfix');
            $table->integer('start_from');
            $table->integer('interval');
            $table->string('example');
            $table->string('duration_round')->default('M');
            $table->string('type');
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
        Schema::dropIfExists('format_invoices');
    }
}
