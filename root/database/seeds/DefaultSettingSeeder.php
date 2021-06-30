<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DefaultSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->delete();
        \DB::table('settings')->insert(array(0 => array(
            'id' => 1,
            'app_name' => "BOQ Control System",
            'report_header'=> "BOQ Control System",
            'report_header_color'=> "#000000",
            'company_name_color'=> "#000000",
            'company_name'=> "BOQ Control System",
            'company_phone'=> "086223238",
            'company_email'=> "info@hello.com",
            'company_address'=> "BOQ Control System",
            'app_icon'=> "assets/upload/temps/app_icon.png",
            'app_logo'=> "assets/upload/temps/app_logo.png",
            'allow_zone'=> 1,
            'allow_block'=> 1,
            'theme_color'=> 'default',
            'theme_style'=> 'square',
            'theme_layout'=> 'fluid',
            'page_header'=> 'fixed',
            'top_menu_dropdown'=> 'light',
            'sidebar_mode'=> 'fixed',
            'sidebar_menu'=> 'accordion',
            'sidebar_style'=> 'default',
            'sidebar_position'=> 'left',
            'page_footer'=> 'default',
            'request_photo'=> 0,
            'order_photo'=> 0,
            'delivery_photo'=> 1,
            'return_delivery_photo'=> 0,
            'usage_photo'=> 0,
            'return_usage_photo'=> 0,
            'usage_constructor'=> 1,
            'return_constructor'=> 1,
            'round_number'=> 2,
            'round_dollar'=> 2,
            'modal_header_color'=> '#2d699e',
            'modal_title_color'=> '#ffffff',
            'format_date'=> 'dd-mm-yyyy',
            'image_size'=> '0,0',
            'is_costing'=> 1,
            'stock_account'=> 'FIFO',
        )));
    }
}
