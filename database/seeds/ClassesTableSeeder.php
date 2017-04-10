<?php

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
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

        $item2 = new \App\Classes();

        $item2->title = 'Lớp 4';
        $item2->description = null;
        $item2->code = 1;
        $item2->isDelete = 0;
        $item2->created_at = null;
        $item2->updated_at = null;
        $item2->save();

        $item3 = new \App\Classes();

        $item3->title = 'Lớp 5';
        $item3->description = null;
        $item3->code = 1;
        $item3->isDelete = 0;
        $item3->created_at = null;
        $item3->updated_at = null;
        $item3->save();

        $item4 = new \App\Classes();

        $item4->title = 'Lớp 6';
        $item4->description = null;
        $item4->code = 2;
        $item4->isDelete = 0;
        $item4->created_at = null;
        $item4->updated_at = null;
        $item4->save();

        $item5 = new \App\Classes();

        $item5->title = 'Lớp 7';
        $item5->description = null;
        $item5->code = 2;
        $item5->isDelete = 0;
        $item5->created_at = null;
        $item5->updated_at = null;
        $item5->save();

        $item6 = new \App\Classes();

        $item6->title = 'Lớp 8';
        $item6->description = null;
        $item6->code = 2;
        $item6->isDelete = 0;
        $item6->created_at = null;
        $item6->updated_at = null;
        $item6->save();

        $item7 = new \App\Classes();

        $item7->title = 'Lớp 9';
        $item7->description = null;
        $item7->code = 2;
        $item7->isDelete = 0;
        $item7->created_at = null;
        $item7->updated_at = null;
        $item7->save();

        $item8 = new \App\Classes();

        $item8->title = 'Lớp 10';
        $item8->description = null;
        $item8->code = 3;
        $item8->isDelete = 0;
        $item8->created_at = null;
        $item8->updated_at = null;
        $item8->save();

        $item9 = new \App\Classes();

        $item9->title = 'Lớp 11';
        $item9->description = null;
        $item9->code = 3;
        $item9->isDelete = 0;
        $item9->created_at = null;
        $item9->updated_at = null;
        $item9->save();

        $item10 = new \App\Classes();

        $item10->title = 'Lớp 12';
        $item10->description = null;
        $item10->code = 3;
        $item10->isDelete = 0;
        $item10->created_at = null;
        $item10->updated_at = null;
        $item10->save();
    }
}
