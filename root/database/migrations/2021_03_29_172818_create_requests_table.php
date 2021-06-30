<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref_no');
            $table->dateTime('trans_date');
            $table->dateTime('delivery_date');
            $table->tinyInteger('trans_status')->default(1)->comment('1=pedding,2=approving,3=completed,4=rejected,0=trashed');
            $table->integer('request_by');
            $table->integer('pro_id');
            $table->integer('dep_id');
            $table->text('note');
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
        Schema::dropIfExists('requests');
    }
}
