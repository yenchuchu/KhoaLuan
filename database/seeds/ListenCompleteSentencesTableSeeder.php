<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\ListenCompleteSentences;

class ListenCompleteSentencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($level = 1; $level<= 6; $level++) {
            // tạo random đề cho hcoj sinh
            foreach (range(1, 30) as $index) {
                $record = new ListenCompleteSentences();

                $num_question = $faker->numberBetween($min = 3, $max = 5);
                $array_option_answers = [];
                for ($i = 1; $i <= $num_question; $i++) {

                    $array_option_answers[$i] = [
                        'id' => $i,
                        'content' => $faker->sentence($nbWords = 3, $variableNbWords = true).'___ what time to do something.',
                        'answer' =>  $faker->name
                    ];

                    //{{"id": "1", "content": "Teenagers can ___ what time to do something.", "answer": "spent"},
                    // {"id": "2", "content": "Playing computer games makes ___ less on their lesson in class.", "answer": "learn"},
                    // {"id": "3", "content": "Teenagers like ___ friends on the Ingernet.", "answer": "making"}}

                }

                $record->title = $faker->sentence(5);
                $record->url = 'English\Grade5\Audios\Unit3\LISTENING\Task2\t2_c2.mp3';
                $record->content_json = json_encode($array_option_answers);
                $record->point = 100;
                $record->type_user = 'ST';

                $record->user_id = 3;
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

//        for ($class = 1; $class<= 10; $class++) {
//            // tạo random đề cho giáo viên
//            foreach (range(1, 30) as $index) {
//                $record = new ListenCompleteSentences();
//
//                $num_question = $faker->numberBetween($min = 3, $max = 5);
//                $array_option_answers = [];
//                for ($i = 1; $i <= $num_question; $i++) {
//
//                    $array_option_answers[$i] = [
//                        'id' => $i,
//                        'content' => $faker->sentence($nbWords = 3, $variableNbWords = true).'___ what time to do something.',
//                        'answer' =>  $faker->name
//                    ];
//                }
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
