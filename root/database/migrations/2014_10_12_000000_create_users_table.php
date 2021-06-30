<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dep_id')->default(0);
            $table->integer('warehouse_id')->default(0);
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('position',100)->nullable();
            $table->string('tel',20)->nullable();
            $table->string('password', 100);
            $table->rememberToken();
            $table->text('photo');
            $table->text('signature');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('users');
    }
}
