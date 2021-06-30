<?php

use Illuminate\Database\Seeder;

class DefaultProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('projects')->insert([
            'id' => 1,
            'name' => 'Default Project',
            'desc' => null,
            'tel' => '086223238',
            'email' => null,
            'url' => null,
            'address' => null,
            'profile' => 'assets/system/project/default_logo.png',
			'cover'	=> 'assets/system/project/default_cover.png',
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
