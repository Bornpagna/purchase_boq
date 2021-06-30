<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIsReviseReferentIdToBoq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boqs', function (Blueprint $table) {
            $table->integer('referent_id')->default(0);
            $table->integer('is_revise')->default(0);
            $table->integer('revise_count')->default(0);
            $table->integer('revise_by')->default(0);
            $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boqs', function (Blueprint $table) {
            $table->integer('referent_id')->default(0);
            $table->integer('is_revise')->default(0);
            $table->integer('revise_count')->default(0);
            $table->integer('revise_by')->default(0);
            $table->integer('status')->default(0);
        });
    }
}
