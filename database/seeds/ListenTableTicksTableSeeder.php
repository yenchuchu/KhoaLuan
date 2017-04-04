<?php

use App\ListenTableTicks;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ListenTableTicksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $array_option_answers = [
            'suggest_choose' => [
                "River",
                "Stadium",
                "Garden",
                "Village yard",
                "High hulding",
                "Bamboo trees",
                "Vegetables"
            ],
            'answer' => ["River", "Village yard", "Vegetables"]
        ];
//        for ($level = 1; $level <= 6; $level++) {
//            $type_code = 1;
//            $class_id = 1;

            // tạo random đề cho hcoj sinh
            foreach (range(1, 20) as $index) {
                $record = new ListenTableTicks();
                $array_option_answers = [
                    'suggest_choose' => [
                        "River",
                        "Stadium",
                        "Garden",
                        "Village yard",
                        "High hulding",
                        "Bamboo trees",
                        "Vegetables"
                    ],
                    'answer' => ["River", "Village yard", "Vegetables"]
                ];

                $record->user_id = 3;
                $record->title = $faker->sentence(5);
                $record->url = 'English\Grade5\Audios\Unit3\LISTENING\Task2\t2_c2.mp3';
                $record->content_json = json_encode($array_option_answers);
                $record->point = 100;
                $record->type_user = 'ST';
                $record->type_code = 1;

                $record->skill_id = 1;
                $record->level_id = 1;
                $record->class_id = 3;
                $record->exam_type_id = null;
                $record->bookmap_id = null;

                $record->created_at = null;
                $record->updated_at = null;

                $record->save();

//                $type_code++;
//                $class_id++;
            }
            foreach (range(1, 20) as $index) {
                $record = new ListenTableTicks();
                $array_option_answers = [
                    'suggest_choose' => [
                        "River",
                        "Stadium",
                        "Garden",
                        "Village yard",
                        "High hulding",
                        "Bamboo trees",
                        "Vegetables"
                    ],
                    'answer' => ["River", "Village yard", "Vegetables"]
                ];

                $record->user_id = 3;
                $record->title = $faker->sentence(5);
                $record->url = 'English\Grade5\Audios\Unit3\LISTENING\Task2\t2_c2.mp3';
                $record->content_json = json_encode($array_option_answers);
                $record->point = 100;
                $record->type_user = 'ST';
                $record->type_code = 2;

                $record->skill_id = 1;
                $record->level_id = 2;
                $record->class_id = 3;
                $record->exam_type_id = null;
                $record->bookmap_id = null;

                $record->created_at = null;
                $record->updated_at = null;

                $record->save();

//                $type_code++;
//                $class_id++;
            }
            foreach (range(1, 20) as $index) {
                $record = new ListenTableTicks();
                $array_option_answers = [
                    'suggest_choose' => [
                        "River",
                        "Stadium",
                        "Garden",
                        "Village yard",
                        "High hulding",
                        "Bamboo trees",
                        "Vegetables"
                    ],
                    'answer' => ["River", "Village yard", "Vegetables"]
                ];

                $record->user_id = 3;
                $record->title = $faker->sentence(5);
                $record->url = 'English\Grade5\Audios\Unit3\LISTENING\Task2\t2_c2.mp3';
                $record->content_json = json_encode($array_option_answers);
                $record->point = 100;
                $record->type_user = 'ST';
                $record->type_code = 3;

                $record->skill_id = 1;
                $record->level_id = 3;
                $record->class_id = 3;
                $record->exam_type_id = null;
                $record->bookmap_id = null;

                $record->created_at = null;
                $record->updated_at = null;

                $record->save();

//                $type_code++;
//                $class_id++;
            }
            foreach (range(1, 20) as $index) {
                $record = new ListenTableTicks();
                $array_option_answers = [
                    'suggest_choose' => [
                        "River",
                        "Stadium",
                        "Garden",
                        "Village yard",
                        "High hulding",
                        "Bamboo trees",
                        "Vegetables"
                    ],
                    'answer' => ["River", "Village yard", "Vegetables"]
                ];

                $record->user_id = 3;
                $record->title = $faker->sentence(5);
                $record->url = 'English\Grade5\Audios\Unit3\LISTENING\Task2\t2_c2.mp3';
                $record->content_json = json_encode($array_option_answers);
                $record->point = 100;
                $record->type_user = 'ST';
                $record->type_code = 4;

                $record->skill_id = 1;
                $record->level_id = 4;
                $record->class_id = 3;
                $record->exam_type_id = null;
                $record->bookmap_id = null;

                $record->created_at = null;
                $record->updated_at = null;

                $record->save();

//                $type_code++;
//                $class_id++;
            }

//        }


//        for ($class = 1; $class <= 10; $class++) {
//            // tạo random đề cho giáo viên
//            foreach (range(1, 30) as $index) {
//                $record = new ListenTableTicks();
//                $array_option_answers = [
//                    'suggest_choose' => [
//                        "River",
//                        "Stadium",
//                        "Garden",
//                        "Village yard",
//                        "High hulding",
//                        "Bamboo trees",
//                        "Vegetables"
//                    ],
//                    'answer' => ["River", "Village yard", "Vegetables"]
//                ];
//
//                $record->title = $faker->sentence(5);
//                $record->url = 'public\English\Grade5\Audios\Unit3\LISTENING\Task2\t2_c2.mp3';
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
