<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constructors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('for id card');
            $table->string('id_card')->comment('for name');
            $table->text('address');
            $table->string('tel',20)->nullable();
            $table->tinyInteger('type')->default(1)->comment('1=engineer, 2=subcontractor');
            $table->tinyInteger('status')->default(1)->comment('1=active,0=disable');
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
        Schema::dropIfExists('constructors');
    }
}
