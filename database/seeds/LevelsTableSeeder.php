<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item1 = new \App\Level();
        $item1->title = 'Level 1';
        $item1->code = 'L1';
        $item1->point = 0;
        $item1->created_at = null;
        $item1->updated_at = null;
        $item1->save();

        $item2 = new \App\Level();
        $item2->title = 'Level 2';
        $item2->code = 'L2';
        $item2->point = 0;
        $item2->created_at = null;
        $item2->updated_at = null;
        $item2->save();

        $item3 = new \App\Level();
        $item3->title = 'Level 3';
        $item3->code = 'L3';
        $item3->point = 0;
        $item3->created_at = null;
        $item3->updated_at = null;
        $item3->save();

        $item4 = new \App\Level();
        $item4->title = 'Level 4';
        $item4->code = 'L4';
        $item4->point = 0;
        $item4->created_at = null;
        $item4->updated_at = null;
        $item4->save();

        $item5 = new \App\Level();
        $item5->title = 'Level 5';
        $item5->code = 'L5';
        $item5->point = 0;
        $item5->created_at = null;
        $item5->updated_at = null;
        $item5->save();

        $item6 = new \App\Level();
        $item6->title = 'Level 6';
        $item6->code = 'L6';
        $item6->point = 0;
        $item6->created_at = null;
        $item6->updated_at = null;
        $item6->save();

    }
}
