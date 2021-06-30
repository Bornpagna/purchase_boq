<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id');
            $table->integer('pr_id');
            $table->integer('dep_id');
            $table->integer('sup_id');
            $table->string('ref_no')->unique();
            $table->dateTime('trans_date');
            $table->dateTime('delivery_date');
            $table->integer('delivery_address');
            $table->integer('trans_status')->default(1)->comment('1=pedding,2=approving,3=completed,4=rejected,0=trashed');
            $table->decimal('sub_total',25,4)->default(0);
            $table->decimal('deposit',25,4)->default(0);
            $table->decimal('tax',25,4)->default(0);
            $table->decimal('fee_charge',25,4)->default(0);
            $table->decimal('discount',25,4)->default(0);
            $table->decimal('disc_perc',25,4)->default(0);
            $table->decimal('disc_usd',25,4)->default(0);
            $table->decimal('grand_total',25,4)->default(0);
            $table->integer('ordered_by');
            $table->text('note');
            $table->string('term_pay')->nullable();
            $table->integer('terms')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
