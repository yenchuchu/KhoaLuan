<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\ListenTableMatchs;

class ListenTableMatchsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        for ($level = 1; $level <= 6; $level++) {
            // tạo random đề cho hcoj sinh
            foreach (range(1, 30) as $index) {
                $record = new ListenTableMatchs();
                $array_option_answers = [
                    "left" => [
                        "title" => "Stages of life",
                        "content" => [
                            ["id" => "1", "content" => "childhood"],
                            ["id" => "2", "content" => "primary school"],
                            ["id" => "3", "content" => "secondary school"]
                        ],
                    ],
                    "right" => [
                        "title" => "Hobbies/Leisure activiries",
                        "content" => [
                            ["id" => "A", "content" => "volunteering"],
                            ["id" => "B", "content" => "playing with toys"],
                            ["id" => "C", "content" => "playing tennis"]
                        ],
                    ],
                    'answer' => ["1-C", "2-A", "3-B"]
                ];

                $record->title = $faker->sentence(5);
                $record->url = 'English\Grade5\Audios\Unit1\LISTENING\Task4\t4_ex.mp3';
                $record->content_json = json_encode($array_option_answers);
                $record->point = 100;
                $record->type_user = 'ST';

                $record->skill_id = 1;
                $record->level_id = $level;
                $record->class_id = $faker->numberBetween($min = 1, $max = 10);
                $record->exam_type_id = null;
                $record->bookmap_id = null;

                $record->created_at = null;
                $record->updated_at = null;

                $record->save();
            }
        }

//        for ($class = 1; $class <= 10; $class++) {
//            // tạo random đề cho giáo viên
//            foreach (range(1, 30) as $index) {
//                $record = new ListenTableMatchs();
//                $array_option_answers = [
//                    "left" => [
//                        "title" => "Stages of life",
//                        "content" => [
//                            ["id" => "1", "content" => "childhood"],
//                            ["id" => "2", "content" => "primary school"],
//                            ["id" => "3", "content" => "secondary school"]
//                        ],
//                    ],
//                    "right" => [
//                        "title" => "Hobbies/Leisure activiries",
//                        "content" => [
//                            ["id" => "A", "content" => "volunteering"],
//                            ["id" => "B", "content" => "playing with toys"],
//                            ["id" => "C", "content" => "playing tennis"]
//                        ],
//                    ],
//                    'answer' => ["1-C", "2-A", "3-B"]
//                ];
//
//                $record->title = $faker->sentence(5);
//                $record->url = 'public\English\Grade5\Audios\Unit1\LISTENING\Task4\t4_ex.mp3';
//                $record->content_json = json_encode($array_option_answers);
//                $record->point = 100;
//                $record->type_user = 'TC';
//
//                $record->skill_id = 3;
//                $record->level_id = null;
//                $record->class_id = $class;
//                $record->exam_type_id = $faker->numberBetween($min = 1, $max = 4);
//                $record->bookmap_id = $faker->numberBetween($min = 1, $max = 11);
//
//                $record->created_at = null;
//                $record->updated_at = null;
//
//                $record->save();
//            }
//        }
    }
}
