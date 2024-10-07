<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branch')->insert(array(
            ['name'=>'ปราจีนบุรี'],
            ['name'=>'นครนายก'],
            ['name'=>'กรุงเทพมหานคร'],
            ['name'=>'ชลบุรี'],
            ['name'=>'เชียงใหม่'],
        ));
    }
}
