<?php

use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item1 = new \App\Classes();

        $item1->title = 'Lớp 3';
        $item1->description = null;
        $item1->code = 1;
        $item1->isDelete = 0;
        $item1->created_at = null;
        $item1->updated_at = null;
        $item1->save();
    }
}
