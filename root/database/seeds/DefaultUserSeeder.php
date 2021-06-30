<?php

use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(
            array(
                // OWNER
                0 => array(
                    'id' => 1,
                    'dep_id' => 0,
                    'warehouse_id' => 0,
                    'name' => 'Owner',
                    'email' => 'owner@gmail.com',
                    'position' => 'System Owner',
                    'tel' => '086223238',
                    'remember_token' => null,
                    'password' => bcrypt('223238'),
                    'photo' => "/team7.jpg",
                    'signature' => '',
                    'status' => 1,
                    'delete' => 0,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ),
                // ADMIN
                1 => array(
                    'id' => 2,
                    'dep_id' => 0,
                    'warehouse_id' => 0,
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'position' => 'System Admin',
                    'tel' => '086223238',
                    'remember_token' => null,
                    'password' => bcrypt('223238'),
                    'photo' => "/team7.jpg",
                    'signature' => '',
                    'status' => 1,
                    'delete' => 0,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ),
            )
        );
    }
}
