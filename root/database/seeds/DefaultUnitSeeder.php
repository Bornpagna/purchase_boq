<?php

use Illuminate\Database\Seeder;

class DefaultUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pr_units = array(
            array('id' => '1','from_code' => 'ដើម','from_desc' => 'ដើម','to_code' => 'ដើម','to_desc' => 'ដើម','factor' => '1','created_by' => '50','created_at' => '2020-12-07 14:52:34','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '2','from_code' => 'តោន','from_desc' => 'តោន','to_code' => 'តោន','to_desc' => 'តោន','factor' => '1','created_by' => '50','created_at' => '2020-12-07 14:53:33','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '3','from_code' => 'បេ','from_desc' => 'បេ','to_code' => 'បេ','to_desc' => 'បេ','factor' => '1','created_by' => '50','created_at' => '2020-12-07 14:53:46','updated_by' => '50','updated_at' => '2020-12-07 14:57:10','status' => '1'),
            array('id' => '4','from_code' => 'តោន','from_desc' => 'តោន','to_code' => 'បេ','to_desc' => 'បេ','factor' => '20','created_by' => '50','created_at' => '2020-12-07 14:53:56','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '5','from_code' => 'គ្រាប់','from_desc' => 'គ្រាប់','to_code' => 'គ្រាប់','to_desc' => 'គ្រាប់','factor' => '1','created_by' => '50','created_at' => '2020-12-07 14:54:20','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '6','from_code' => 'កេស','from_desc' => 'កេស','to_code' => 'កេស','to_desc' => 'កេស','factor' => '1','created_by' => '50','created_at' => '2020-12-07 14:55:30','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '7','from_code' => 'សុង','from_desc' => 'សុង','to_code' => 'សុង','to_desc' => 'សុង','factor' => '1','created_by' => '50','created_at' => '2020-12-07 14:55:41','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '8','from_code' => 'គីប','from_desc' => 'គីប','to_code' => 'គីប','to_desc' => 'គីប','factor' => '1','created_by' => '50','created_at' => '2020-12-07 14:56:01','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '9','from_code' => 'ឡាន','from_desc' => 'ឡាន','to_code' => 'ឡាន','to_desc' => 'ឡាន','factor' => '1','created_by' => '50','created_at' => '2020-12-07 14:56:11','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '10','from_code' => 'ឡានតូច','from_desc' => 'ឡានតូច','to_code' => 'គីប','to_desc' => 'គីប','factor' => '7','created_by' => '50','created_at' => '2020-12-07 14:56:30','updated_by' => '50','updated_at' => '2020-12-07 14:57:56','status' => '1'),
            array('id' => '11','from_code' => 'ឡានធំ','from_desc' => 'ឡានធំ','to_code' => 'គីប','to_desc' => 'គីប','factor' => '13','created_by' => '50','created_at' => '2020-12-07 14:57:47','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '12','from_code' => 'ដុំ','from_desc' => 'ដុំ','to_code' => 'ដុំ','to_desc' => 'ដុំ','factor' => '1','created_by' => '50','created_at' => '2020-12-07 14:58:14','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '13','from_code' => 'គីឡូ','from_desc' => 'គីឡូ','to_code' => 'គីឡូ','to_desc' => 'គីឡូ','factor' => '1','created_by' => '50','created_at' => '2020-12-07 15:41:08','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '14','from_code' => 'ដុំ','from_desc' => 'ដុំ','to_code' => 'គីឡូ','to_desc' => 'គីឡូ','factor' => '11.6','created_by' => '50','created_at' => '2020-12-07 15:41:27','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '15','from_code' => 'ម៉ែត្រគូប','from_desc' => 'ម៉ែត្រគូប','to_code' => 'ម៉ែត្រគូប','to_desc' => 'ម៉ែត្រគូប','factor' => '1','created_by' => '50','created_at' => '2020-12-09 09:30:00','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '16','from_code' => 'កង','from_desc' => 'កង','to_code' => 'កង','to_desc' => 'កង','factor' => '1','created_by' => '50','created_at' => '2020-12-09 09:41:27','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '17','from_code' => 'ប្រអប់','from_desc' => 'ប្រអប់','to_code' => 'គ្រាប់','to_desc' => 'គ្រាប់','factor' => '50','created_by' => '53','created_at' => '2020-12-09 14:21:35','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '18','from_code' => 'គីឡូ','from_desc' => 'គីឡូ','to_code' => 'គ្រាប់','to_desc' => 'គ្រាប់','factor' => '300','created_by' => '53','created_at' => '2020-12-09 14:28:20','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '19','from_code' => 'កំប៉ុង','from_desc' => 'កំប៉ុង','to_code' => 'កំប៉ុង','to_desc' => 'កំប៉ុង','factor' => '1','created_by' => '50','created_at' => '2020-12-09 15:21:21','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '20','from_code' => 'ម៉ែត្រ','from_desc' => 'ម៉ែត្រ','to_code' => 'ម៉ែត្រ','to_desc' => 'ម៉ែត្រ','factor' => '1','created_by' => '54','created_at' => '2020-12-17 10:06:35','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '21','from_code' => 'ឈុត','from_desc' => 'ឈុត','to_code' => 'ឈុត','to_desc' => 'ឈុត','factor' => '1','created_by' => '54','created_at' => '2020-12-17 10:06:35','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '22','from_code' => 'ដប','from_desc' => 'ដប','to_code' => 'ដប','to_desc' => 'ដប','factor' => '1','created_by' => '54','created_at' => '2020-12-17 10:06:35','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '23','from_code' => 'ធុង','from_desc' => 'ធុង','to_code' => 'ធុង','to_desc' => 'ធុង','factor' => '1','created_by' => '54','created_at' => '2020-12-17 10:06:35','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '24','from_code' => 'លីត្រ','from_desc' => 'លីត្រ','to_code' => 'លីត្រ','to_desc' => 'លីត្រ','factor' => '1','created_by' => '54','created_at' => '2020-12-17 10:06:35','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '25','from_code' => 'សន្លឹក','from_desc' => 'សន្លឹក','to_code' => 'សន្លឹក','to_desc' => 'សន្លឹក','factor' => '1','created_by' => '54','created_at' => '2020-12-17 10:06:35','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '26','from_code' => 'ប៉ាវ','from_desc' => 'ប៉ាវ','to_code' => 'ប៉ាវ','to_desc' => 'ប៉ាវ','factor' => '1','created_by' => '54','created_at' => '2020-12-17 10:06:35','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '27','from_code' => 'គូរ','from_desc' => 'គូរ','to_code' => 'គូរ','to_desc' => 'គូរ','factor' => '1','created_by' => '54','created_at' => '2020-12-17 10:06:35','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '28','from_code' => 'កញ្ចប់','from_desc' => 'កញ្ចប់','to_code' => 'កញ្ចប់','to_desc' => 'កញ្ចប់','factor' => '1','created_by' => '54','created_at' => '2020-12-17 10:06:35','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '29','from_code' => 'គ្រឿង','from_desc' => 'គ្រឿង','to_code' => 'គ្រឿង','to_desc' => 'គ្រឿង','factor' => '1','created_by' => '50','created_at' => '2020-12-21 14:53:57','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '30','from_code' => 'បាវ','from_desc' => 'បាវ','to_code' => 'បាវ','to_desc' => 'បាវ','factor' => '1','created_by' => '50','created_at' => '2020-12-21 14:53:57','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '31','from_code' => 'ខ្សែ','from_desc' => 'ខ្សែ','to_code' => 'ខ្សែ','to_desc' => 'ខ្សែ','factor' => '1','created_by' => '50','created_at' => '2020-12-21 14:57:04','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '32','from_code' => 'កង់','from_desc' => 'កង់','to_code' => 'កង់','to_desc' => 'កង់','factor' => '1','created_by' => '50','created_at' => '2020-12-21 14:57:04','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '33','from_code' => 'ឡាន','from_desc' => 'ឡាន','to_code' => 'ដុំ','to_desc' => 'ដុំ','factor' => '10000','created_by' => '50','created_at' => '2020-12-22 08:27:22','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '34','from_code' => 'បាច់','from_desc' => 'បាច់','to_code' => 'បាច់','to_desc' => 'បាច់','factor' => '1','created_by' => '52','created_at' => '2021-01-29 14:41:36','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '35','from_code' => 'ការ៉េ','from_desc' => 'ការ៉េ','to_code' => 'ការ៉េ','to_desc' => 'ការ៉េ','factor' => '1','created_by' => '39','created_at' => '2021-02-05 08:53:41','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '36','from_code' => 'ប្រអប់','from_desc' => 'ប្រអប់','to_code' => 'ប្រអប់','to_desc' => 'ប្រអប់','factor' => '1','created_by' => '50','created_at' => '2021-02-17 08:38:31','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '37','from_code' => 'កេស60x60-4','from_desc' => 'កេស','to_code' => 'ការ៉េ','to_desc' => 'ការ៉េ','factor' => '1.44','created_by' => '54','created_at' => '2021-03-04 11:27:52','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '38','from_code' => 'កេស80x80-3','from_desc' => 'កេស','to_code' => 'ការ៉េ','to_desc' => 'ការ៉េ','factor' => '1.92','created_by' => '54','created_at' => '2021-03-04 11:28:46','updated_by' => '54','updated_at' => '2021-03-04 11:31:01','status' => '1'),
            array('id' => '39','from_code' => 'កេស30x60-8','from_desc' => 'កេស','to_code' => 'ការ៉េ','to_desc' => 'ការ៉េ','factor' => '1.44','created_by' => '54','created_at' => '2021-03-04 11:29:21','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '40','from_code' => 'កេស40x80-6','from_desc' => 'កេស','to_code' => 'ការ៉េ','to_desc' => 'ការ៉េ','factor' => '1.92','created_by' => '54','created_at' => '2021-03-04 11:30:18','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '41','from_code' => 'កេស60x120','from_desc' => 'កេស','to_code' => 'ការ៉េ','to_desc' => 'ការ៉េ','factor' => '1.44','created_by' => '54','created_at' => '2021-03-04 11:32:22','updated_by' => NULL,'updated_at' => NULL,'status' => '1'),
            array('id' => '42','from_code' => 'កេស30x30','from_desc' => 'កេស','to_code' => 'ការ៉េ','to_desc' => 'ការ៉េ','factor' => '1.35','created_by' => '54','created_at' => '2021-03-04 11:33:08','updated_by' => NULL,'updated_at' => NULL,'status' => '1')
        );
        \DB::table('units')->delete();
        \DB::table('units')->insert($pr_units);
    }
}
