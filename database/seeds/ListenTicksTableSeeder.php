<?php

use App\ListenTicks;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ListenTicksTableSeeder extends Seeder
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
            foreach (range(1, 30) as $key => $index) {
                $record = new ListenTicks();
                $array_example_answers = [
                    'id' => 1,
                    'content' => [
                        'A' => 'English\Grade3\images\Unit1\Part1\Task1\p1_t1_c1_a.jpg',
                        'B' => 'English\Grade3\images\Unit1\Part1\Task1\p1_t1_c1_b.jpg'
                    ],
                    'url_audio' => 'English\Grade5\Audios\Unit3\LISTENING\Task2\t2_c2.mp3',
                    'answer' => 'A'
                ];

                $num_question = $faker->numberBetween($min = 3, $max = 5);
                $array_option_answers = [];
                for ($i = 1; $i <= $num_question; $i++) {
                    $array_option_answers[$i] = [
                        'id' => $i,
                        'content' => [
                            'A' => 'English\Grade3\images\Unit1\Part1\Task1\p1_t1_c1_a.jpg',
                            'B' => 'English\Grade3\images\Unit1\Part1\Task1\p1_t1_c1_b.jpg'
                        ],
                        'url_audio' => 'English\Grade5\Audios\Unit3\LISTENING\Task2\t2_c2.mp3',
                        'answer' => $faker->randomElement($array = array ('A', 'B'))
                    ];
                }

                $record->title = $faker->sentence(5);
                $record->url = '';
                $record->content_json = json_encode($array_option_answers);
                $record->point = 100;
                $record->type_user = 'ST';
                $record->example_json = json_encode($array_example_answers);

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

    }
}
