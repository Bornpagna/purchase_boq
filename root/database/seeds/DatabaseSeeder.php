<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DefaultSettingSeeder::class);
        $this->call(DefaultUserSeeder::class);
        $this->call(DefaultProjectSeeder::class);
        $this->call(DefaultInvoiceFormatSeeder::class);
        $this->call(DefaultPageActionSeeder::class);
        $this->call(DefaultUnitSeeder::class);
    }
}
