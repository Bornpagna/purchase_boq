<?php

use Illuminate\Database\Seeder;

class DefaultInvoiceFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('format_invoices')->insert(array(
            0 => array(
                'id'            => 1,
                'format_code'   => 'FRM-ENT',
                'format_name'   => 'Stock Entry',
                'length'        => 9,
                'prefix'        => 'ENT-!YY!!MM!/',
                'subfix'        => '',
                'start_from'    => 1,
                'interval'      => 1,
                'example'       => 'ENT-1801/0000001',
                'duration_round'=> 'M',
                'type'          => 'ENT',
                'status'        => 1,
                'created_by'    => 1,
                'updated_by'    => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ),
            1 => array(
                'id'            => 2,
                'format_code'   => 'FRM-IMP',
                'format_name'   => 'Stock Import Excel',
                'length'        => 9,
                'prefix'        => 'IMP-!YY!!MM!/',
                'subfix'        => '',
                'start_from'    => 1,
                'interval'      => 1,
                'example'       => 'IMP-1801/000000001',
                'duration_round'=> 'M',
                'type'          => 'IMP',
                'status'        => 1,
                'created_by'    => 1,
                'updated_by'    => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ),
            2 => array(
                'id'            => 3,
                'format_code'   => 'FRM-ADJ',
                'format_name'   => 'Stock Adjustment',
                'length'        => 9,
                'prefix'        => 'ADJ-!YY!!MM!/',
                'subfix'        => '',
                'start_from'    => 1,
                'interval'      => 1,
                'example'       => 'ADJ-1801/000000001',
                'duration_round'=> 'M',
                'type'          => 'ADJ',
                'status'        => 1,
                'created_by'    => 1,
                'updated_by'    => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ),
            3 => array(
                'id'            => 4,
                'format_code'   => 'FRM-MOV',
                'format_name'   => 'Stock movement',
                'length'        => 9,
                'prefix'        => 'MOV-!YY!!MM!/',
                'subfix'        => '',
                'start_from'    => 1,
                'interval'      => 1,
                'example'       => 'MOV-1801/000000001',
                'duration_round'=> 'M',
                'type'          => 'MOV',
                'status'        => 1,
                'created_by'    => 1,
                'updated_by'    => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ),
            4 => array(
                'id'            => 5,
                'format_code'   => 'FRM-USE',
                'format_name'   => 'Usage items',
                'length'        => 9,
                'prefix'        => 'USE-!YY!/!MM!/',
                'subfix'        => '',
                'start_from'    => 1,
                'interval'      => 1,
                'example'       => 'USE-18/01/000000001',
                'duration_round'=> 'M',
                'type'          => 'USE',
                'status'        => 1,
                'created_by'    => 1,
                'updated_by'    => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ),
            5 => array(
                'id'            => 6,
                'format_code'   => 'FRM-REU',
                'format_name'   => 'Return usage items',
                'length'        => 9,
                'prefix'        => 'REU-!YY!!MM!/',
                'subfix'        => '',
                'start_from'    => 1,
                'interval'      => 1,
                'example'       => 'REU-1801/000000001',
                'duration_round'=> 'M',
                'type'          => 'REU',
                'status'        => 1,
                'created_by'    => 1,
                'updated_by'    => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ),
            6 => array(
                'id'            => 7,
                'format_code'   => 'FRM-RED',
                'format_name'   => 'return delivery stock',
                'length'        => 9,
                'prefix'        => 'RED-!YY!!MM!/',
                'subfix'        => '',
                'start_from'    => 1,
                'interval'      => 1,
                'example'       => 'RED-1802/000000001',
                'duration_round'=> 'M',
                'type'          => 'RED',
                'status'        => 1,
                'created_by'    => 1,
                'updated_by'    => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ),
        ));
    }
}
