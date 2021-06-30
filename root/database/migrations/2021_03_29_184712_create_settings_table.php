<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('app_name');
            $table->string('report_header');
            $table->string('report_header_color')->default('#000000');
            $table->string('company_name_color')->default('#000000');
            $table->string('company_name')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_address')->nullable();
            $table->string('app_icon')->nullable();
            $table->string('app_logo')->nullable();
            $table->tinyInteger('allow_zone')->default(1)->comment('1=allow zone, 0=not allow');
            $table->tinyInteger('allow_block')->default(1)->comment('1=allow block, 0=not allow');
            $table->string('theme_color')->default('default');
            $table->string('theme_style')->default('square');
            $table->string('theme_layout')->default('fluid');
            $table->string('page_header')->default('fixed');
            $table->string('top_menu_dropdown')->default('light');
            $table->string('sidebar_mode')->default('fixed');
            $table->string('sidebar_menu')->default('accordion');
            $table->string('sidebar_style')->default('default');
            $table->string('sidebar_position')->default('left');
            $table->string('page_footer')->default('default');
            $table->tinyInteger('request_photo')->default(1);
            $table->tinyInteger('order_photo')->default(1);
            $table->tinyInteger('delivery_photo')->default(1);
            $table->tinyInteger('return_delivery_photo')->default(1);
            $table->tinyInteger('usage_photo')->default(1);
            $table->tinyInteger('return_usage_photo')->default(1);
            $table->tinyInteger('usage_constructor')->default(1);
            $table->tinyInteger('return_constructor')->default(1);
            $table->smallInteger('round_number')->default(2);
            $table->smallInteger('round_dollar')->default(2);
            $table->string('modal_header_color')->default('#2d699e');
            $table->string('modal_title_color')->default('#ffffff');
            $table->string('format_date')->default('dd-mm-yyyy');
            $table->string('image_size')->default('0,0');
            $table->tinyInteger('is_costing')->default(0);
            $table->string('stock_account')->default('None')->comment("AVGC,FIFO,LIFO");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
