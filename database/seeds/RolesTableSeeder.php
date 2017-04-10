<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item1 = new \App\Role();
        $item1->name = 'Teacher';
        $item1->code = 'TC';
        $item1->isDelete = 0;
        $item1->created_at = null;
        $item1->updated_at = null;
        $item1->save();

        $item1 = new \App\Role();
        $item1->name = 'student';
        $item1->code = 'ST';
        $item1->isDelete = 0;
        $item1->created_at = null;
        $item1->updated_at = null;
        $item1->save();

        $item1 = new \App\Role();
        $item1->name = 'Admin';
        $item1->code = 'AD';
        $item1->isDelete = 0;
        $item1->created_at = null;
        $item1->updated_at = null;
        $item1->save();

        $item1 = new \App\Role();
        $item1->name = 'Author';
        $item1->code = 'AT';
        $item1->isDelete = 0;
        $item1->created_at = null;
        $item1->updated_at = null;
        $item1->save();
    }
}
