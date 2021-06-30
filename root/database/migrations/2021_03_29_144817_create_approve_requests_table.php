<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApproveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approve_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pr_id');
            $table->integer('role_id');
            $table->integer('approved_by');
            $table->text('signature');
            $table->dateTime('approved_date');
            $table->tinyInteger('reject')->default(0);
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
        Schema::dropIfExists('approve_requests');
    }
}
